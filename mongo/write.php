<?php

use MongoDB\Driver\BulkWrite;
use MongoDB\Driver\Manager;

$bulk = new BulkWrite();
$document1 = ['title'=>'one'];

$_id1 = $bulk->insert($document1);

var_dump($_id1);

$manager = new Manager('mongodb://localhost:27017');
$result = $manager->executeBulkWrite('phpbasics.test',$bulk);