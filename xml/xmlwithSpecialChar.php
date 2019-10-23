<?php
$dir = __DIR__;
$file = 'xmlwithSpecialChar.xml';

$string = file_get_contents($dir . '/' . $file);
$string=preg_replace('/&(?!#?[a-z0-9]+;)/', '&amp;', $string);


$obj = simplexml_load_string($string);

print_r($obj);
