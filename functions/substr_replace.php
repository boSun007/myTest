<?php
$a="abcdefghijklmnopqrstuvwxyz";

echo substr_replace($a,"***",3,5);

echo PHP_EOL;

$email = 'user@example.com';
$domain = strstr($email, '@');
echo $domain;

echo PHP_EOL;
$order ="2019-04-03 11:29:12";
echo date("Y-m-d",strtotime($order));

echo trim("a j s i  d o");



