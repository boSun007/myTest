<?php

$a = new stdClass();
$a->a=['a','b'];
var_dump(is_object($a));

$b='asfsdfsadfasf';
var_dump(strlen($b));


$a=microtime(true);

$a=microtime(true)-$a;
echo $a;