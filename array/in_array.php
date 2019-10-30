<?php

$arr = [
    'a'=>'A',
    'b'=>false,
    'c'=>true,
    'd'=>0,
];

$res = in_array(0,$arr,true);

var_dump($res);
