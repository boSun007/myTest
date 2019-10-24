<?php

$arr = [
    123,
    456,
    789,
];


$sar = [
    456,
    741,
    325,
    123,
    789,
];

foreach ($sar as $sa) {
    // $key = array_search($sa, $arr);
    if($key = array_search($sa, $arr) !== false){
        echo $key;
        unset($arr[$key]);
        print_r($arr);
    }
}
