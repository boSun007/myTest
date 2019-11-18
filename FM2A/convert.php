<?php

namespace FM2A;

class convert
{

    private $agent;
    private $checkinDate;
    private $checkoutDate;
    private $src = 'UKD';
    private $avail = 'True';
    private $buildWorks = 'Y';
    private $mealBasis;
    private $starRating;
    private $regions;
    private $subregion;
    private $propcode;
    private $propname;
    private $search;
    private $priceMin;
    private $priceMax;

    public function searchRequestConvert($xml)
    {
        $this->parseSearchRequest($xml);
        $FM2AResponse = $this->getFM2AResponse();
        $response = \simplexml_load_string($FM2AResponse);

        var_dump($response);

        
    }

    private function parseSearchRequest($xml)
    {
        $this->parseLoginDetails($xml);
        $this->parseDate($xml);
        $this->parseRegins($xml->SearchDetails);
        $this->parseRoomRequests($xml->SearchDetails->RoomRequests);
    }

    private function parseRoomRequests($roomRequests)
    {
        $key = 1;
        $chlidAges = array();

        foreach ($roomRequests->RoomRequest as $roomRequest) {

            foreach ($roomRequest->ChildAges->ChildAge as $age) {
                $childAges[] = ['CHILDAGE' => (int) $age->Age];
            }

            $this->search[]['SEARCH'] = [
                'SEARCHID' => $key,
                'ROOMQTY' => 1,
                'ADULTS' => $roomRequest->Adults,
                'CHILDS' => $childAges,
            ];
            $key++;
            $childAges = array();
        }

        return $this->search;
    }

    private function parseDate($xml)
    {
        $searchDetails = $xml->SearchDetails;
        $this->checkinDate = date('Ymd', strtotime($searchDetails->ArrivalDate));
        $duration = $searchDetails->Duration;
        $this->checkoutDate = date('Ymd', \strtotime($this->checkinDate . "+{$duration} days"));
    }

    private function parseRegins($searchDetails)
    {
        $this->region[] = $searchDetails->RegionID ? $searchDetails->RegionID : false;
        // $subRegion = $searchDetails->SubRegionID?$searchDetails->SubRegionID:false;
        $this->propcode = $searchDetails->Properties ? $searchDetails->Properties : $searchDetails->PropertyID ? $searchDetails->PropertyID : false;

        // die(var_dump($searchDetails->PropertyID));
        die(var_dump($searchDetails->Properties ?$searchDetails->Properties:$searchDetails->PropertyID?$searchDetails->PropertyID:'N'));
        die(var_dump($searchDetails->Properties));
    }


    private function parseLoginDetails($xml)
    {
        $loginDetails = $xml->LoginDetails;

        $res = $loginDetails->Login;

        if ($loginDetails->Login == 'Virgin' && $loginDetails->Password == 'L_9oe2INRuqMW') {
            $this->agent = 'VIR';
        }
        return $this->agent;
    }

    private function getFM2AResponse()
    {
        $searchRequestXML = $this->makeSearchRequestXML();

        $this->postFM2ARequest($searchRequestXML);
    }

    private function postFM2ARequest($searchRequestXML)
    {
        echo $searchRequestXML;
//         die();
//         $a =  \str_replace('\r\n','', trim($searchRequestXML));
//    var_dump( $a == "<AVAILALLSEARCH><AGENT>VIR</AGENT><CHECKINDATE>20200801</CHECKINDATE><CHECKOUTDATE>20200806</CHECKOUTDATE><SRC>UKD</SRC><AVAIL>True</AVAIL><REGIONS></REGIONS><PROPCODE>crys03</PROPCODE><SEARCHES><SEARCH><SEARCHID>1</SEARCHID><ROOMQTY>1</ROOMQTY><ADULTS>2</ADULTS><CHILDS><CHILDAGE>8</CHILDAGE><CHILDAGE>3</CHILDAGE></CHILDS></SEARCH><SEARCH><SEARCHID>2</SEARCHID><ROOMQTY>1</ROOMQTY><ADULTS>2</ADULTS><CHILDS><CHILDAGE>8</CHILDAGE><CHILDAGE>8</CHILDAGE></CHILDS></SEARCH></SEARCHES></AVAILALLSEARCH>");
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "http://v3vir.xml.cullinan.systems/accom/test/availallsearch.pl",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
        //   CURLOPT_POSTFIELDS => "<AVAILALLSEARCH><AGENT>VIR</AGENT><CHECKINDATE>20200801</CHECKINDATE><CHECKOUTDATE>20200806</CHECKOUTDATE><SRC>UKD</SRC><AVAIL>True</AVAIL><REGIONS></REGIONS><PROPCODE>crys03</PROPCODE><SEARCHES><SEARCH><SEARCHID>1</SEARCHID><ROOMQTY>1</ROOMQTY><ADULTS>2</ADULTS><CHILDS><CHILDAGE>8</CHILDAGE><CHILDAGE>3</CHILDAGE></CHILDS></SEARCH><SEARCH><SEARCHID>2</SEARCHID><ROOMQTY>1</ROOMQTY><ADULTS>2</ADULTS><CHILDS><CHILDAGE>8</CHILDAGE><CHILDAGE>8</CHILDAGE></CHILDS></SEARCH></SEARCHES></AVAILALLSEARCH>",
          CURLOPT_POSTFIELDS => $searchRequestXML,
          CURLOPT_HTTPHEADER => array(
            "Accept: */*",
            "Accept-Encoding: gzip, deflate",
            "Cache-Control: no-cache",
            "Connection: keep-alive",
            "Content-Length: 499",
            "Content-Type: application/xml",
            "Host: v3vir.xml.cullinan.systems",
            "Postman-Token: bb9e531a-0afc-437b-9944-d0b270b24610,6b2431ad-16b2-4b25-8374-61380f489233",
            "User-Agent: PostmanRuntime/7.19.0",
            "cache-control: no-cache"
          ),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
          return $response;
        }
    }


    private function makeSearchRequestXML()
    {
        $xml = "<AVAILALLSEARCH><AGENT>{$this->agent}</AGENT><CHECKINDATE>{$this->checkinDate}</CHECKINDATE><CHECKOUTDATE>{$this->checkoutDate}</CHECKOUTDATE><SRC>{$this->src}</SRC><AVAIL>{$this->avail}</AVAIL><REGIONS>";
        if ($this->regions) {
            foreach ($this->regions as $region) {
                $xml .= "<REGION>{$region}</REGION>";
            }
        }
        $xml .= "</REGIONS>";

        if ($this->subregion) {
            foreach ($this->subregion as $subregion) {
                $xml .= "<SUBREGION>{$subregion}</SUBREGION>";
            }
        }

        if ($this->propcode) {
            foreach ($this->propcode as $propcode) {
                $xml .= "<PROPCODE>{$propcode}</PROPCODE>";
            }
        }
        if ($this->propname) {
            foreach ($this->propname as $propname) {
                $xml .= "<PROPNAME>{$propname}</PROPNAME>";
            }
        }

        if ($this->search) {
            // $xml = '';
            $xml .= "<SEARCHES>";
            foreach ($this->search as $search) {
                $xml .= "<SEARCH>";
                $xml .= "<SEARCHID>{$search['SEARCH']['SEARCHID']}</SEARCHID>";
                $xml .= "<ROOMQTY>{$search['SEARCH']['ROOMQTY']}</ROOMQTY>";
                $xml .= "<ADULTS>{$search['SEARCH']['ADULTS']}</ADULTS>";
                if ($search['SEARCH']['CHILDS']) {
                    $xml .= "<CHILDS>";
                    foreach ($search['SEARCH']['CHILDS'] as $child) {
                        $xml .= "<CHILDAGE>{$child['CHILDAGE']}</CHILDAGE>";
                    }
                    $xml .= "</CHILDS>";
                }
                $xml .= "</SEARCH>";
            }
            $xml .= "</SEARCHES>";
        }
        $xml .= "</AVAILALLSEARCH>";

        return $xml;
    }
}
