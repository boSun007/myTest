<?php
include __DIR__.'/../vendor/autoload.php';

$m = new MongoClient();
$db = $m->selectDB('example');