<?php
$dir = dirname(__FILE__);
$resp = simplexml_load_file($dir.'/response.xml');
// $resp = simplexml_load_file($dir.'/twoPassage.xml');
$a['BookingInfoResponses'] = json_decode(json_encode($resp),true);

$resp = $a;

if (isset($resp['BookingInfoResponses']['ResponseList']['anyType'])) {
    $resp = $resp['BookingInfoResponses']['ResponseList']['anyType'];
}

// var_dump(count($resp['PassengerDetails']['PassengerDetails']));
// var_dump($resp['PassengerDetails']['PassengerDetails']);

if (isset($resp['PassengerDetails']['PassengerDetails'])) {
    for ($i = 1; $i < count($resp['PassengerDetails']['PassengerDetails']); $i++) {
        if(key_exists($i,$resp['PassengerDetails']['PassengerDetails'])){
            $gd = $resp['PassengerDetails']['PassengerDetails'][$i];
        }else{
            $gd = $resp['PassengerDetails']['PassengerDetails'];
        }
        if (!empty($gd['FirstName'])) {
            $guests[] = array("Guest" => array(
                "Type" => ($gd['PassengerType'] == 'Adult' ? 'Adult' : 'Child'),
                "FirstName" => $gd['FirstName'],
                "LastName" => $gd['LastName'],
                "Title" => $gd['Title'],
                "Age" => $gd['PassengerAge'],
            ));
        }
    }
}