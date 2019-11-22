<?php

$file = __DIR__.'/dataType.xml';

$xml = simplexml_load_file($file);
$xml = json_decode(json_encode($xml));
var_dump($xml);

