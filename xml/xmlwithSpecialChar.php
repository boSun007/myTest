<?php
$dir = __DIR__;
$file = 'xmlwithSpecialChar.xml';
 
$string = file_get_contents($dir . '/' . $file);
$string=preg_replace('/&(?!#?[a-z0-9]+;)/', '&amp;', $string);

$string ='<age>20</age>';
$obj = simplexml_load_string($string);
var_dump($obj);



var_dump(json_decode(json_encode($obj),true));
