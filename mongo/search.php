<?php

$filter = [
    // "score"=>30,
    "score"=> 
    [ 
        '$gte'=>30,
        '$lt'=>50,

    ]
    ];
$options = array(
    /* Only return the following fields in the matching documents */
    "projection" => array(
        // "hello" => 1,
        // "article" => 1,
        "score"=>1,
    ),
    "sort" => array(
        "views" => -1,
    ),
    "modifiers" => array(
        '$comment'   => "This is a query comment",
        '$maxTimeMS' => 100,
    ),
);

$query = new MongoDB\Driver\Query($filter, $options);

$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
$readPreference = new MongoDB\Driver\ReadPreference(MongoDB\Driver\ReadPreference::RP_PRIMARY);
$cursor = $manager->executeQuery("db.collection", $query, $readPreference);

foreach($cursor as $document) {
    var_dump($document);
}