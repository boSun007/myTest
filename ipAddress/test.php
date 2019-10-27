<?php

use SerenityLib\IPFilter;

require_once("../common.php");
require_once("XML.php");

require_once("../SerenityLib/IPFilter.php");

$ip = '192.168.10.175';
$size=30;
$LoginID=33;
$tag='develop';


$res = IPFilter::setIpRange($ip,$size,$LoginID,$tag);

$res = IPFilter::isAllowed($ip,$LoginID);


var_dump($res);
