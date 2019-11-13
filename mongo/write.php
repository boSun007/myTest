<?php

use MongoDB\Driver\BulkWrite;
use MongoDB\Driver\Manager;

$bulk = new BulkWrite();
$document1 = ['_id'=>3390,'title'=>'one'];

$_id1 = $bulk->insert($document1);
echo $_id1;
die();
var_dump($_id1);

$manager = new Manager('mongodb://localhost:27017');
$result = $manager->executeBulkWrite('phpbasics.test',$bulk);