<?php
include __DIR__ . '/../autoload.php';

use FM2A\convert;

$xml = simplexml_load_file(__DIR__.'/searchRequest.xml');

$convert = new convert();

switch(strtolower($xml->getName())){
    case "searchrequest":
        $convertedXML = $convert->searchRequestConvert($xml);
    break;
    
}

// var_dump($convertedXML);