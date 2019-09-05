<?php

include_once dirname(__FILE__)."/../autoload.php";

// require 'Predis/Autoloader.php';


$host = [
    '192.168.10.82',
    '127.0.0.1',
];

$redis = new Predis\Client();