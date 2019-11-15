<?php

use mongo\log_test\mongoClass;
use MongoDB\BSON\ObjectId;
use MongoDB\Driver\Query;

include __DIR__.'/../../autoload.php';

$mongo = mongoClass::gi();

/********************** USE _id Search *************************************/

$filter = [
    'RequestID'=>
        [
            '$eq' => '99999',
            
        ],
    'RawQuery.LoginDetails.Login'=>
    [
        '$eq' => 'Yalago',
        
    ],
     
    ]; 

    $options = [];





$query = new Query($filter,$options);

$rows = $mongo->executeQuery('log.test',$query)->toArray();

print_r($rows);


