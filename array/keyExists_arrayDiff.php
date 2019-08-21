<?php

$arr = array();
$arr=[
    "abc"=>['a','b','b','d'],
    'aaa'=>['aa','bb','cc','dd'],
    'ccc'=>['ca','cb','cc','cd'],
];

var_dump(in_array('bb',$arr));
var_dump(key_exists('aAa',$arr));


/****************array_diff()*************** */
$a = ['a','b','c'];
$b = ['k1'=>'a','k2'=>'b','k3'=>'c'];
$c = array_values($b);
var_dump(array_diff($a,$b));

echo hash("md5","3453668435");
