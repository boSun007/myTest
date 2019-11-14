<?php

use mongo\log_test\mongoClass;
use MongoDB\BSON\ObjectId;
use MongoDB\Driver\Query;

$mongo = mongoClass::gi();

/********************** USE _id Search *************************************/

$_id = 3;
$id = new ObjectId($_id);
$options = [];
$query = new Query($filter,$options);

$rows = $mongo->executeQuery('log.test',$query)->toArray();

print_r($rows);


