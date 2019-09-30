<?php
$foo = 'ABCDE';
$foo = [
    'a',
    'b',
    'c',
    'd',
    'e'
];

var_dump($foo{3});


if (!isset($foo{5})) {
    echo "FFFF";
}else{
    echo "CCCCC";
}

$x=1;


$a = (false && print_r("ccc"));
$a = (true && print_r("ccc"));
$b = (true  || print_r("ccc"));
$c = (false and print_r("ccc"));
$d = (true  or  print_r("ccc"));

var_dump($x);
// exit;



$a=7;
$b=10;

$a=9 && $b=99;
echo '$a='.$a.'---$b='.$b;


exit;

if($a=9 && $b=99 ){
    echo 'lll';
    echo "LINE 1: ".$a."---".$b;
}

echo "LINE 2: ".$a."---".$b;