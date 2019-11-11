<?php
require_once __DIR__ . "/../vendor/autoload.php";

use Elasticsearch\ClientBuilder;

$client = ClientBuilder::create()->build();

$params = [
    'index' => 'my_index',
    'id' => 'my_id',
    'body' => [
        'settings'=>[
            'number_of_shards'=>2,
            'number_of_replicas'=>1,
        ],
        'testField' => 'abc',
    ],
];


$response = $client->index($params);
print_r($response);
