<?php

$redis = new redis();
$redis->connect('localhost');
$string = $redis->get('myNameIs');

$hash = $redis->hGet('myHash','name');

var_dump($hash);



$arr = [
    'key1'=>'value1',
    'key2'=>'value2',
    'key3'=>'value3',
    'key4'=>'value4',
    'key5'=>'value5',
    'key6'=>'value6',
    'key7'=>'value7',
    'key8'=>[
        'k1'=>'v1',
        'k2'=>'v2',
    ],
];

$redis->hMSet('newHash',$arr);
$keys = $redis->exists('abc');
// var_dump($keys);exit;

$newHash = $redis->hGet('newHash','key8');

$redis->set('arrStr',json_encode($arr));
$arrStr = json_decode($redis->get('arrStr'));
// var_dump($arrStr);
$hall = $redis->hGetAll('newHash');

var_dump($hall);
