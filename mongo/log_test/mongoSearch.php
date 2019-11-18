<?php

use mongo\log_test\mongoClass;
use MongoDB\Driver\Query;

include __DIR__.'/../../autoload.php';

$mongo = mongoClass::gi();

/********************** USE _id Search *************************************/

$filter = [
    //where RequestID = '99999;  AND...
    // 'RequestID'=>
    //     [
    //         // '$eq' => '99999',
    //         '$eq' => '1',
            
    //     ],
        'RawQuery.ReturnStatus.Success'=>[
            '$eq'=>'True'
        ],
        '$or'=>[
            [
                'condition1'=>[
                    '$gt'=>3,
                ],
            ],
            [
                'condition2'=>[
                    '$gt'=>4,
                ]
            ]
        ]

    // 'RawQuery.LoginDetails.Login'=>
    // [
    //     '$eq' => 'Yalago',
        
    // ],
     
    ]; 
 
    $options = [
        "projection" =>[
            //SQL: select RequestID from .....
            "RequestID"=>1,
        ],
        "sort"=>[
            //order by Request ID Desc
            'RequestID'=>-1
        ],
        "limit"=>3
    ];





$query = new Query($filter,$options);

$rows = $mongo->executeQuery('log.test',$query)->toArray();

print_r($rows);


