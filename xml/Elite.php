<?php
$dir = dirname(__FILE__);
$resp = simplexml_load_file($dir.'/EliteResult@15.xml');

print_r($resp);