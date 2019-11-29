<?php
$a= 9223372036854775807;
$b = 9223372036854775808;

var_dump($a);
echo PHP_EOL;
var_dump($b);
echo PHP_EOL;
var_dump($a==($b-1));