<?php


include_once dirname(__FILE__)."/../autoload.php";

use ipAddress\myIPFilter;



$ip = '192.168.10.175';

// echo long2ip(ip2long($ip)+1);exit;

$mask = 16;

$newIp = '192.168.10.215';

echo long2ip(3232238253);
echo long2ip(3232238254);
exit;
// echo ip2long($newIp);exit;

$myFilter = new myIPFilter($ip,$mask);
// $myFilter = new myIPFilter($ip);

$res =  $myFilter->getRange();

var_dump($res);
$res = $myFilter->inTheRange($ip);


var_dump($res);

