<?php

$dir = dirname(__FILE__).'/';
// include $dir.'../'."vendor/autoload.php";
// $type = '/roomAvailablilityCheck/request/';


// $schema =json_decode(file_get_contents($dir.$type."schema.json"));
// $json = json_decode(file_get_contents($dir.$type."fullJson.json"));

$json = file_get_contents($dir.'booking.json');

$arr = json_decode($json,true);

print_r($arr);