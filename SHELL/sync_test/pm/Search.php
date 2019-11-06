<?php

require_once("Room.php");
require_once("Property.php");
require_once("Supplier.php");

class Search extends Loggable {
	protected $properties = array();
	protected $contracts = array();
	protected $roomRequests = array();
	protected $roomRequestsResults = array();
	protected $_virtualProps = array();
	protected $supplier = false;

	public function __construct() {
		parent::init();
	}

	protected function getRooms($rr, $params=array()) {
		$this->log->add("Searching for room query:");
		$this->log->addHash($rr);
		$rooms = $this->queryRooms(array_merge($rr, $params));
		if(empty($rooms)) {
			$this->log->add("Could not find any rooms matching query");
			return $rooms;
		}

		$this->log->add("Found Rooms:");
		$this->log->addHash(RoomManager::formatLog($rooms, array(
			"roomKeys"=>array("Cost"),
			"supplements"=>true,
		)));
		return $rooms;
	}

	protected function queryRooms($params) {
		$rooms = array();
		foreach($this->contracts as $c) {
			$cRooms = RoomManager::getRooms_Contract($c['ContractID']);
			$rooms = array_merge($rooms, $cRooms);
		}
		$this->log->add("Got Contract rooms:");
		$this->log->addHash(RoomManager::formatLog($rooms, array("roomKeys"=>array('PropertyRoomTypeID', 'ContractID'))));
		RoomManager::filters($rooms, $params, false, $this->log);

		return $rooms;
	}

	protected function getContracts($params) {
		$this->contracts = $this->queryContracts($params);
		$this->contracts = $this->filterContractsBlacklist($this->contracts);
		$this->contracts = $this->filterContractsInMinMaxDays($this->contracts, $params);
		if(count($this->contracts) == 0) {
			throw new Exception("Could not find any Contracts that match your query");
		}
		$this->log->add("Found Contracts:");
		$this->log->addHash(Util::plucks($this->contracts, "Reference", "ContractID"));
	}
	
	protected function getCancellationTerms($params) {
	    foreach ($this->roomRequestsResults as $rooms) {
	        foreach ($rooms as $room) {
	            $room->addCancellationSchedule($params);
	        }
	    }
	}

	protected function filterContractsInMinMaxDays($contracts, $params) {
		foreach($contracts as &$c) {
			if(!$this->isContractInMinMaxDays($c['ContractID'], $params)) {
				$this->log->add("Found contract not meeting min/max days: ".$c['Reference']);
				$c = false;
			}
		}
		return __()->compact($contracts);
	}
	protected function isContractInMinMaxDays($contractID, $params) {
		$min = 0;
		$max = 0;

		$query = DB::gi()->selectGen(array(
			"table"=>array("ContractMinimumDays"),
			"select"=>"MinimumDays",
			"where"=>array(
				"ContractID=$contractID",
				DB::date($params['ArrivalDate']).">= StartDate",
				DB::date($params['ArrivalDate'])."<= EndDate",
			),
		));
		if(count($query) >= 1) {
			$min = $query[0]['MinimumDays'];
		}
		$query = DB::gi()->selectGen(array(
			"table"=>array("ContractMinMaxStay"),
			"select"=>"MinStay, MaxStay",
			"where"=>array(
				"ContractID=$contractID",
				"ContractRoomTypeID=0",
				DB::date($params['ArrivalDate']).">= StartDate",
				DB::date($params['ArrivalDate'])."<= EndDate",
				"DayType='All Days'",
			),
		));
		if(count($query) >= 1) {
			if($query[0]['MinStay'] != 0) {
				$min = $query[0]['MinStay'];
			}
			$max = $query[0]['MaxStay'];
		}

		if($min != 0 && $params['Duration'] < $min) {
			return false;
		}
		if($max != 0 && $params['Duration'] > $max) {
			return false;
		}

		return true;
	}
	
	protected function filterContractsBlacklist($contracts) {
	    global $_contractsBlacklist;
	    foreach ($contracts as $k => $c) {
	        if (in_array($c['ContractID'], $_contractsBlacklist)) {
	            $this->log->add("Found blacklisted contract: ".$c['Reference']." [ID: ".$c['ContractID']."]");
	            unset($contracts[$k]);
	        }
	    }
	    return $contracts;
	}

	protected function queryContracts($params) {
		$params['PropertyID'] = __()->pluck($this->properties, "PropertyID");
		if($params['ArrivalDate'] < $params['BookingDate']) {
			throw new Exception("Arrival Date before today");
		}
		//hotfix - 02/04/2015 - 10am
		if(defined("IS_BOOKING_SEARCH")) {
			$minDaysBefore = 3;
			if($params['ArrivalDate'] < (time()+(60*60*24)*$minDaysBefore)) {

				global $XMLTradeUser;
				$allow = array(
					1203,
				);
				if(!in_array($XMLTradeUser->getTradeID(), $allow)) {
					throw new Exception("Arrival Date is less than the minimum [$minDaysBefore] days before arrival");
				}
			}
		}
		$arrivalDate = DB::date($params['ArrivalDate']);
		$departureDate = Util::departureDate($params);
		$where = array(
			"Status='Live'",
			DB::date($params['BookingDate'])." between BookingStartDate and BookingEndDate",
			"$arrivalDate between StayStartDate and StayEndDate",
			"dateadd(d,-1,$departureDate) between StayStartDate and StayEndDate",
		);
		if(isset($params['TradeID'])) {
			$where[]= "ContractID IN (SELECT ContractID from TradeContract where TradeID=".$params['TradeID'].")";
		}

		//don't select contract T&C, slows query down substantially
		$cols = array(
		  'ContractID', 'ContractParentID', 'PropertyID', 'SystemUserID', 'Reference', 'Category', 'ContractCategoryID', 'AppliesTo', 'AppliesToID', 'BookingSourceID', 'BookingAuthorityID', 'ContractIdentifier', 'Status', 'ContractDate', 'Type', 'BookingStartDate', 'BookingEndDate', 'StayStartDate', 'StayEndDate', 'NetContract', 'CommissionOverride', 'CommissionOverrideValue', 'PriceOnArrival', 'SpecialOffer', 'SpecialOfferCode', 'CurrencyID', 'CancellationSystemUserID', 'CancellationDate', 'CancellationReason', 'MaximumRooms', 'CompleteStayOnly', 'PaymentTermID', /*'TermsAndConditionsOnline', */ /*'TermsAndConditionsCallCentre', */ 'Deposit', 'ContractSigned', 'Notes', 'InvoicePeriod',
		);

		$contracts = DB::gi()->selectGen(array(
			"table"=>array("Contract"),
			"select"=>implode(",", $cols),
			"where"=>$where,
			"whereGen"=>array($params, array(
				"PropertyID",
			)),
		));

		//Hotfix to exclude Trade Set: CHARTER BB & TS
		$contractsF = array();
		foreach($contracts as $c) {
			if($c['AppliesTo'] == 'Trade Set') {
				if(in_array($c['AppliesToID'], array(1276))) {
					$this->log->add("Excluding contract '{$c['Reference']}' as it's in an excluded trade set");
					continue;
				}
			}
			$contractsF[]= $c;
		}

		return $contractsF;
	}

	protected function getProperties(&$params) {
		$this->filterVirtualProperties($params);
		$this->properties = $this->queryProperties($params);
		if(count($this->properties) == 0) {
			global $XMLTradeUser;
			$sups = $XMLTradeUser->getSuppliers();
			foreach($sups as $s) {
				$sup = Supplier::create($s);
				$props = $sup->getProperties($params);
				if(count($props)) {
					$this->properties = $props;
					$this->supplier = $sup;
					$this->log->add("Found supplier [$s]");
					break;
				}
			}
			if (!is_array($this->properties)) {
				throw new Exception("Internal error retrieving properties");
			}
			if(count($this->properties) == 0) {
				throw new Exception("Could not find any Properties that match your query");
			}
		}
		$this->log->add("Found Properties:");
		$this->log->addHash(__()->pluck($this->properties, "Name"));
	}

	protected function filterVirtualProperties(&$params) {
		global $XMLTradeUser;
		$pids = false;
		// pids already validated twice by the time they get here
		if (isset($params['PropertyIDs'])) {
			$pids = implode(", ", $params['PropertyIDs']);
		}
		if (isset($params['PropertyID'])) {
			if ($pids) {
				$pids .= ', ' . $params['PropertyID'];
			} else {
				$pids = $params['PropertyID'];
			}
		}
		if(!$pids) {
			return;
		}

		$sql = "SELECT * FROM PropertyVirtual
			   WHERE TradeID={$XMLTradeUser->getTradeID()} AND SrcPropertyID IN ($pids)";

		$rtn = DB::gi()->select($sql);

		if(!count($rtn)) {
			$this->log->add("Found no virtual properties");
			return;
		}
		$this->log->add("Found Virtual Property: ".count($rtn)."x");

		if(!isset($params['MealBasisIDs'])) {
			$params['MealBasisIDs'] = array();
		}
	
		$toRemove = array();
		foreach($rtn as $p) {
			$toRemove[]= $p['SrcPropertyID'];
			$params['PropertyIDs'][]= $p['DestPropertyID'];
			$params['MealBasisIDs'][]= $p['DestMealBasisID'];
			$this->log->add("Adding virtual property [{$p['SrcPropertyID']}] in as PropertyID: [{$p['DestPropertyID']}] MealBasisID: [{$p['DestMealBasisID']}]");
			if(!isset($this->_virtualProps[$p['DestPropertyID']])) {
				$this->_virtualProps[$p['DestPropertyID']] = array();
			}
			if(!isset($this->_virtualProps[$p['DestPropertyID']][$p['SrcPropertyID']])) {
				$this->_virtualProps[$p['DestPropertyID']][$p['SrcPropertyID']] = array();
			}
			$this->_virtualProps[$p['DestPropertyID']][$p['SrcPropertyID']][]= $p['DestMealBasisID'];
			$this->log->add("Added {$p['DestMealBasisID']} to virtualProps for: ".$p['DestPropertyID']);
		}

		$params['PropertyIDs'] = array_unique(array_diff($params['PropertyIDs'], $toRemove));
		$params['MealBasisIDs'] = array_unique($params['MealBasisIDs']);

		if(count($rtn) > 0 && count($params['PropertyIDs']) > 1) {
			throw new Exception("Currently only 1 virtual property is allowed per query");
		}
	}

	protected function queryProperties($params) {
		$where = array(
			"CurrentProperty=1",
			"(ExcludeFromRes=0)",
		);
		global $XMLTradeUser;
		if($XMLTradeUser->getTradeID() == 1203) {
			$where = array(
				"CurrentProperty=1",
				"(ExcludeFromRes=0 OR PropertyID IN(14, 180, 181))",
			);
		}
		if(isset($params['PropertyIDs']) && count($params['PropertyIDs'])) {
			$where[]= "PropertyID IN (".implode(', ', $params['PropertyIDs']).")";
		}
		$rs = $XMLTradeUser->getRegionSuffix();
		$properties = DB::gi()->selectGen(array(
			"table"=>array("Property",array("GeographyLevel3$rs"=>array("GeographyLevel3ID", "GeographyLevel3ID$rs"))),
			"select"=>"Property.*",
			"where"=>$where,
			"whereGen"=>array($params, array(
				"GeographyLevel2ID",
				"GeographyLevel3$rs.GeographyLevel3ID",
			)),
		));
		foreach($properties as &$p) {
			// some ratings have chars like 4½ which need converting. Everything which is longer than 1 is assumed to be a half value.
			if(strlen($p['Rating']) > 1) {
				$p['Rating'] = intval($p['Rating']) + .5;
			}
		}
		unset($p);
		$newProps = array();
		$foundNonElite = false;
		global $XMLTradeUser;
		$tid = $XMLTradeUser->getTradeID();
		$allowed = !$XMLTradeUser->getEliteOnlyStatus(); //status true => not allowed
		
		if($allowed) { // all
		    $foundNonElite = true;
		    
		    foreach($properties as $p) {
		        
		        if($p['PropertyID'] == 17 && $params['Duration'] < 7) {
		            //BA need to have 6 because of their system
		            //global $XMLTradeUser;
		            if($XMLTradeUser->getTradeID() == 1017) {
		                if($params['Duration'] < 6) {
		                    continue;
		                }
		            } else {
		                continue;
		            }
		        }
		        
		        $newProps[]= $p;
		    }
		} else { // only Elite, PropertyGroupID == 7
		    
		    foreach($properties as $p) {
		        
		        if($p['PropertyGroupID'] == 7)
		        {
		            
		            if($p['PropertyID'] == 17 && $params['Duration'] < 7) {
		                //BA need to have 6 because of their system
		                //global $XMLTradeUser;
		                if($XMLTradeUser->getTradeID() == 1017) {
		                    if($params['Duration'] < 6) {
		                        continue;
		                    }
		                } else {
		                    continue;
		                }
		            }
		            
		            $newProps[]= $p;
		        }
		    }	    
		}
		if(count($newProps) == 0 && $foundNonElite) {
			if(!$allowed) {
				throw new Exception("Non-Elite Hotel not Supported");
			}
		}
		
		$properties = $newProps;
		if(isset($params['MinStarRating'])) {
			$properties = __()->filter($properties, function($p) use($params) {
				return $p['Rating'] > $params['MinStarRating'];
			});
		}
		return $properties;
	}

	public function search($params, $validate = true) {
		$dog = new Datadog\DogStatsd(Prefs::gi()->get('ddogSettings'));
		$tags = Prefs::gi()->get('ddogTags');

		if(!isset($params['_HOTFIX_BA_IS_BOOKING_CREATE']) || !$params['_HOTFIX_BA_IS_BOOKING_CREATE']) {
			$GLOBALS['_HOTFIX_BA_IS_BOOKING_CREATE'] = false;
		}
		$this->log->add("Starting search with params:");
		$this->log->addHash($params);
		$searchValidateTiming = microtime(true);
		if ($validate) {
			self::validateSearchParams($params);
		}
		$searchValidateTiming = microtime(true) - $searchValidateTiming;
		$tags['code_block']='XML_ValidateSearch';
		$dog->timing('XML_Feed.timings.breakdown',$searchValidateTiming,1.0,$tags);

		$searchGetPropertiesTiming = microtime(true);
		$this->getProperties($params);
		$searchGetPropertiesTiming = microtime(true) - $searchGetPropertiesTiming;
		$tags['code_block']='XML_searchGetPropertiesTiming';
		$dog->timing('XML_Feed.timings.breakdown',$searchGetPropertiesTiming,1.0,$tags);
		// set the number of properties into the Datadog tags
		$prefs = Prefs::gi();
		$ddogTags = $prefs->get('ddogTags');
		$propertyCount = count($this->properties);
		$ddogTags['property_count'] = $propertyCount;
		$prefs->set('ddogTags', $ddogTags);

		if($this->supplier) {
			$this->log->add("Calling supplier search");
			$searchSupplierSearchTiming = microtime(true);
			$this->supplier->search($params, $this->log);
			$searchSupplierSearchTiming = microtime(true) - $searchSupplierSearchTiming;
			$tags['code_block']='XML_searchSupplierSearchTiming';
			$dog->timing('XML_Feed.timings.breakdown',$searchSupplierSearchTiming,1.0,$tags);
			return;
		}
		$searchGetContractsTiming = microtime(true);
		$this->getContracts($params);
		$searchGetContractsTiming = microtime(true) - $searchGetContractsTiming;
		$tags['code_block']='XML_searchGetContractsTiming';
		$dog->timing('XML_Feed.timings.breakdown',$searchGetContractsTiming,1.0,$tags);

		$this->roomRequestsResults = array();
		$this->roomRequests = $params['RoomRequests'];
		$rrCount = count($params['RoomRequests']);
		$searchGetRoomsTiming = microtime(true);
		for($i=0; $i < $rrCount; $i++) {
			$this->roomRequestsResults[$i] = $this->getRooms($params['RoomRequests'][$i], $params);
			if(!$this->roomRequestsResults[$i]) {
				throw new Exception("Could not find any rooms for RoomRequest #".($i+1));
			}
		}
		$searchGetRoomsTiming = microtime(true) - $searchGetRoomsTiming;
		$tags['code_block']='XML_searchGetRoomsTiming';
		$dog->timing('XML_Feed.timings.breakdown',$searchGetRoomsTiming,1.0,$tags);

		$searchgetCancellationTermsTiming = microtime(true);
		$this->getCancellationTerms($params);
		$searchgetCancellationTermsTiming = microtime(true) - $searchgetCancellationTermsTiming;
		$tags['code_block']='XML_searchgetCancellationTermsTiming';
		$dog->timing('XML_Feed.timings.breakdown',$searchgetCancellationTermsTiming,1.0,$tags);
		// if we only have one Room Request, or one Property then skip filter and go to the end.
		if ($rrCount == 1 || $propertyCount == 1) {
			return;
		}

		//1 find the largest array in $result act as base for array_diff_key
		//2 $newResult = array_key_diff through the $result
		//2.5 find which the roomID belongs to the result
		//3 go through the $newResutl to unset($this->roomRequestResults)
		
		$tags['room_requests_count'] = $rrCount;
		$ddogMultiRoomRequestFilterStartTime = microtime(true);


		//use $result to hold the search result as per room request
		$this->log->add('Filter out rooms where Property cannot fulfill all room requests');
		$result = array();
		$hash = array();
		$searchgetContractRoomTypeIDTiming = microtime(true);
		for ($i = 0; $i < count($this->roomRequestsResults); $i++) {
			foreach ($this->roomRequestsResults[$i] as $key => $value) {
				$result[$i][$value->getContractRoomTypeID()] = $key;
			}
		}
		$searchgetContractRoomTypeIDTiming = microtime(true) - $searchgetContractRoomTypeIDTiming;
		$tags['code_block']='XML_searchgetContractRoomTypeIDTiming';
		$dog->timing('XML_Feed.timings.breakdown',$searchgetContractRoomTypeIDTiming,1.0,$tags);

		for ($i = 0; $i < count($result); $i++) {
			foreach ($result  as $key => $value) {
				$tmp[] = array_diff_key($result[$i], $result[$key]);
			}
		}

		$searchHashRoomTiming = microtime(true);
		foreach ($tmp as $key => $tmpp) {
			foreach ($tmpp as $roomTypeID => $k) {
				foreach ($this->roomRequestsResults as $kk => $value) {
					foreach ($value as $kkk => $vvv) {
						if ($vvv->getContractRoomTypeID() == $roomTypeID) {
							$hash[$roomTypeID]='Room has been removed';
							unset($this->roomRequestsResults[$kk][$kkk]);
						}
					}
				}
			}
		}
		$searchHashRoomTiming = microtime(true) - $searchHashRoomTiming;
		$tags['code_block']='XML_searchHashRoomTiming';
		$dog->timing('XML_Feed.timings.breakdown',$searchHashRoomTiming,1.0,$tags);

		
		$dog->timing("XML_Feed.filter_multi_room", microtime(true)-$ddogMultiRoomRequestFilterStartTime, 1.0, $ddogTags);
		
		$this->log->addHash($hash);
	}
	
	protected static function validateSearchParams($params) {
		if (!isset($params['TradeID']) || !ctype_digit((string)$params['TradeID'])) {
			throw new Exception('TradeID is required');
		}
		$location = false;
		if (isset($params['PropertyID'])) {
			if (ctype_digit((string)$params['PropertyID']) &&  $params['PropertyID'] > 0) {
				$location = true;
			} else {
				throw new Exception('PropertyID must be a positive number');
			}
		}
		if (isset($params['PropertyIDs'])) {
			foreach ($params['PropertyIDs'] as $p) {
				$p = (string)$p;
				if (!ctype_digit($p) || $p <= 0) {
					throw new Exception('PropertyIDs must be positive numbers');
				}
			}
			$location = true;
		}
		if (isset($params['GeographyLevel3ID']) && !empty($params['GeographyLevel3ID'])) {
			$location = true;
			// no more 'location' validation than this was being done in XML
		}
		if (isset($params['GeographyLevel2ID'])) {
			$location = true;
			if ($params['GeographyLevel2ID'] <= 0) {
				throw new Exception("Invalid RegionID: [{$params['GeographyLevel2ID']}");
			}
		}
		if (!$location) {
			throw new Exception('You must specify either a RegionID, PropertyID, 1+ Properties/PropertyID or 1+ Resorts/Resort/ResortID');
		}
	
		if (!isset($params['ArrivalDate']) || !ctype_digit((string)$params['ArrivalDate'])) {
			throw new Exception('ArrivalDate is required');
		} else {
			$earliestArrival = new DateTime(date('Y-m-d', time()));
			$arrivalDate = new DateTime(date('Y-m-d', $params['ArrivalDate']));
			if ($arrivalDate < $earliestArrival) {
				//XXX
				if(gethostname() == 'Evan-PC') {
				} else {
					throw new Exception('ArrivalDate must be on or after today');
				}
			}
		}
		if (!isset($params['Duration']) || !ctype_digit((string)$params['Duration'])) {
			throw new Exception('Duration is required');
		}
		if ($params['Duration'] < 1 || $params['Duration'] > 88) {
			throw new Exception("Duration must be between 1 and 88");
		}
		self::validateRoomRequests($params);
		return true;
	}
	
	protected static function validateRoomRequests($params) {
		if (!isset($params['RoomRequests']) || !is_array($params['RoomRequests']) || empty($params['RoomRequests'])) {
			throw new Exception("At least one RoomRequest is required");
		}
		
		foreach($params['RoomRequests'] as $rr) {
			self::validateRoomRequest($rr);
		}
		return true;
	}
	
	protected static function validateRoomRequest($rr) {
		foreach ($rr as $r) {
			$paxCount = 0;
			if (isset($rr['Adults']) && ctype_digit((string)$rr['Adults'])) {
				if ($rr['Adults'] < 0) {
					throw new Exception('Adults must be a positive number');
				}
				$paxCount+=$rr['Adults'];
			}
			if (isset($rr['Children']) && ctype_digit((string)$rr['Children'])) {
				if ($rr['Children'] > 2) {
					throw new Exception('Maximum number of children supported is two.');
				}
				if ($rr['Children'] < 0) {
					throw new Exception('Children must be a positive number');
				}
				$paxCount+=$rr['Children'];
			}
			if (isset($rr['Infants']) && ctype_digit((string)$rr['Infants'])) {
				if ($rr['Infants'] < 0) {
					throw new Exception('Infants must be a positive number');
				}
				$paxCount+=$rr['Infants'];
			}
			if ($paxCount == 0) {
				throw new Exception('You must specify at least one Adult, Child or Infant for each RoomRequest');
			}
			
			if (isset($rr['ChildAges']) && !empty($rr['ChildAges'])) {
				if (count($rr['ChildAges']) != $rr['Children']) {
					throw new Exception('You must specify a ChildAge for each child');
				}
				foreach ($rr['ChildAges'] as $ca) {
					if (!ctype_digit((string)$ca) || $ca < 0) {
						throw new Exception('Child age must be a positive number');
					}
					if ($ca < 1) {
						throw new Exception("Child age must be 1 or higher");
					}
				}
			}else{
				throw new Exception('You must specify a ChildAge for each child');
			}
		}
		return true;
	}

	public function getAllData() {
		return array(
			"properties"=>$this->properties,
			"contracts"=>$this->contracts,
			"roomRequestsResults"=>$this->roomRequestsResults,
		);
	}

	public function getResultData($filter = false) {
		global $XMLTradeUser;

		if($this->supplier) {
			return $this->supplier->getSearchResultData($filter);
		}
		
		//sort rooms by property
		$propRooms = array();
		$i = 0;
		foreach($this->roomRequestsResults as $rr) {
			foreach($rr as $room) {
				$rm = $room->getXMLMeta();
				if(!in_array($XMLTradeUser->getTradeID(), array(1085, 1116))) {
					$rm['Name'] .= " ".$rm['View'];
				}
				$pid = $rm['PropertyID'];
				if(!isset($propRooms[$pid])) {
					$propRooms[$pid] = array();
				}
				$rm['OnRequest'] = $rm['ContractBasis'] == 'On Request';
				$rm['Adults'] = $this->roomRequests[$i]['Adults'];
				$rm['Children'] = $this->roomRequests[$i]['Children'];
				$rm['Infants'] = $this->roomRequests[$i]['Infants'];
				
				$keys = array(
					"RoomID",
					"PropertyRoomTypeID", // BA requested so that they can identify the room and change the name. Enabled in XMLBookingLogin table
					"RateCode",
					"ContractRoomTypeID", // TODO - why are we returning this?
					"MealBasisID",
					"Name",
					"Adults",
					"Children",
					"Infants",
					"OnRequest",
					"SubTotal",
					"Total",
					"RoomsAppliesTo",
					"Supplements",
					"SpecialOffers",
					"Taxes",
				    "CancellationPolicies",
					"NoInventory",
				);
				if($XMLTradeUser->rateCodeEnabled() !== true) {
					$newKeys = array();
					foreach($keys as $v) {
						if($v != 'RateCode') {
							$newKeys[]= $v;
						}
					}
					$keys = $newKeys;
				}
				if($XMLTradeUser->propertyRoomTypeEnabled() !== true) {
					$newKeys = array();
					foreach($keys as $v) {
						if($v != 'PropertyRoomTypeID') {
							$newKeys[]= $v;
						}
					}
					$keys = $newKeys;
				}
				$rm = Util::getKeys($rm, $keys, null);
				$rm['RoomID'] = $rm['ContractRoomTypeID'];
				$rm['RoomsAppliesTo'] = array(array('RoomRequest' => $i+1));
				unset($rm['ContractRoomTypeID']);
				if(!$rm['NoInventory']) {
					unset($rm['NoInventory']);
				}
				// hide from XML output so that BookResponse can match output.
				foreach($rm['Taxes'] as $c=>$t) {
					unset($rm['Taxes'][$c]['Tax']['Type']);
					unset($rm['Taxes'][$c]['Tax']['Basis']);
					unset($rm['Taxes'][$c]['Tax']['Value']);
				}
				$propRooms[$pid][]= array('RoomType'=>$rm);
			}
			$i++;
		}
		$data = array();

		

		//Split & Copy Rooms for Virtual Return
		$propRoomsNew = array();
		foreach($propRooms as $pid=>$rooms) {
			if(!isset($this->_virtualProps[$pid])) {
				$propRoomsNew[$pid] = $rooms;
				continue;
			}

			foreach($rooms as $r) {
				$mb = $r['RoomType']['MealBasisID'];
			
				foreach($this->_virtualProps[$pid] as $vpid=>$mbs) {
					if(in_array($mb, $mbs)) {
						if(!isset($propRoomsNew[$vpid])) {
							$propRoomsNew[$vpid] = array();
						}
						$propRoomsNew[$vpid][]= $r;
					}
				}
			}
		}

		foreach($propRoomsNew as $pid=>&$rooms) {
			$p = array();
			$p['TotalProperties'] = count($propRooms);
			$p['PropertyID'] = $pid;

			foreach($this->_virtualProps as $pidSrc=>$vpids) {
				if(in_array($pid, array_keys($vpids)) !== false) {
					$pid = $pidSrc;
					break;
				}
			}

			$p['RoomTypes'] = $rooms;
			$keys = array(
				"PropertyName",
				"Currency",
				"Rating",
				"GeographyLevel1ID",
				"GeographyLevel2ID",
				"GeographyLevel3ID",
				"Country",
				"Region",
				"Resort",
				"Strapline",
				"Description",
				"CMSBaseURL",
				"MainImage",
				"MainImageThumbnail",
				"Images",
			);
			$pm = Util::getKeys(Property::getPropertyMeta($pid), $keys, null);
			$p = array_merge($p, $pm);

			if($XMLTradeUser->getTradeID() == 1203) {
				$p['Description'] = substr($p['Description'], 0, 1500);
			}

			$data[]= array("PropertyResult"=>$p);
		}

		if($filter === "XML") {
			return Util::arrayToXml("PropertyResults", $data);
		}
		return $data;
	}
}
