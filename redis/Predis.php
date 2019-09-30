<?php
namespace redis;

use Predis\Client;

include dirname(__FILE__).'/../'."vendor/autoload.php";


// require 'Predis/Autoloader.php';


// $host = [
//     '127.0.0.1',
//     '192.168.10.177',
// ];

// $host = '192.168.10.177';
// $host = '127.0.0.1';
$redis = new Client($host);
// $redis->select(0);
$val = $redis->set('myNameIs','boSun');
$val = $redis->get('myNameIs');
var_dump($val);