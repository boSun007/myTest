<?php

$arg =['abc','def']; 
$myFunc = function ($arg){
    print_r($arg);
};

$a = $myFunc;
var_dump($a);