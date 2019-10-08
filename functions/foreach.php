<?php

function myTest(){
    $rtn = false;
    for($i=0;$i<10;$i++){
        if($i<10){
            continue;
        }
        $rtn = true;
        break;
    }
    var_dump($rtn);
    echo $i;
}

myTest();


	 function validatePrice($params) {
		try {
			/* Get the base rate entries to cover the entire stay */
			

			
			
			for($i=0; $i<$params['Duration']; $i++) {
				$found = false;
				foreach($baseRate as $r) {
					if(!($day->getTimestamp() >= $r['StartDate']->getTimestamp() && $day->getTimestamp() <= $r['EndDate']->getTimestamp())) {
						/*
						if (!$day->getTimestamp() >= $r['StartDate']->getTimestamp()) {
							error_log("fail a: " . $day->getTimestamp() . " >= " . $r['StartDate']->getTimestamp());
						}
						if (!$day->getTimestamp() <= $r['EndDate']->getTimestamp()) {
							error_log("fail b: " . $day->getTimestamp() . " <= " . $r['EndDate']->getTimestamp());
						}
						//error_log("continue 1");
						*/
						continue;
					}
					
					

					

					// Calculate the actual room rate for each child. The average room rate for chilren
					// is untouched. e.g. with rates in table of 1 child = $50 and 2 children = $110 gives average 55
					// per child.
					// The rate for child 1 is actually $50 and for child 2 is $60
				

	
					$found = true;
					break;

                }

                if(!$found) {
					throw new Exception("No base rate found for: ".$day->format("Y-m-d"). " a=$adults y=$youths c=$children");
				}
				
				$day->add(new DateInterval('P1D'));
			}
			
			
			
			

			
		} catch(Exception $e) {
			$this->log->add("Room [ContractRoomTypeID:".$this->crt['ContractRoomTypeID']."] failed price validation: [{$e->getMessage()}]");
			return false;
		}
		return true;
	}