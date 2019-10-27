<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019-03-15
 * Time: 11:22
 */



$p4 = function() {
    return 3+4;
};


echo $p4();

echo "<hr />";
$arr = ['a','b','c','d','e'];


function a(){ echo "1";}
function b(){ echo "2";}
function c(){ echo "3";}
function d(){ echo "4";}
function e(){ echo "5";}

foreach($arr as $func){
    $func();
    echo "<hr />";
}