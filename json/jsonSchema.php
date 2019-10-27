<?php

use \JsonSchema\validator;



$dir = dirname(__FILE__).'/';
include $dir.'../'."vendor/autoload.php";
$type = '/roomAvailablilityCheck/request/';


$schema =json_decode(file_get_contents($dir.$type."schema.json"));
$json = json_decode(file_get_contents($dir.$type."fullJson.json"));

echo json_last_error_msg() ;

// $a= file_get_contents($dir.$type."json.json");
// $jj = json_decode($a,true);
// $guestsCount = $jj['guestcounts'];
// $jj['guestcounts']=new stdClass();
// $jj['guestcounts']->a=$guestsCount;
// $jj['guestcounts']->b=$guestsCount;
// $jj['guestcounts']->c=$guestsCount;


// echo json_encode($jj);exit;
// echo print_r($jj);exit;


$validator = new validator();
$validator->validate($json,$schema);

if ($validator->isValid()) {
    echo "The supplied JSON validates against the schema.\n";
} else {
    echo "JSON does not validate. Violations:\n";
    foreach ($validator->getErrors() as $error) {
        echo sprintf("[%s] %s\n", $error['property'], $error['message']);
    }
}


// $json = json_decode($json);



// var_dump($a);