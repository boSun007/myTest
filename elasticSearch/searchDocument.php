<?php
require_once __DIR__ . "/../vendor/autoload.php";

use Elasticsearch\ClientBuilder;


$client = ClientBuilder::create()->build();

$params = [
    'index' => 'my_index',
    'body' => [
        'query' => [
            'match' => [
                'testField' => 'abc'
            ],
        ],
    ],
];

$response = $client->search($params);
print_r($response);
