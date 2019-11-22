<?php
$file = __DIR__.'/getName.xml';
$str = file_get_contents($file);
// echo $str;
// $xml = simplexml_load_file(__DIR__.'/getName.xml');

$xml = simplexml_load_string($str);
// $xml=false;

var_dump($xml);

$xml->getName();

var_dump($xml);