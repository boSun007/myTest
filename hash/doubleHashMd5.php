<?php

$string1 = "ABCDE";

$string2 =null;
echo md5($string2);
echo PHP_EOL;

echo $hash = md5(md5($string1).md5($string2));
echo PHP_EOL;
echo $newHash = md5(md5($string1));

var_dump($hash === $newHash);