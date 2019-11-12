<?php
$dir = dirname(__FILE__);
$xml = simplexml_load_file($dir.'/'.'bookRequest.xml');


print_r($xml->SearchDetails->PropertyID);