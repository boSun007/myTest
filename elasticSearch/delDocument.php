<?php

use Elasticsearch\ClientBuilder;

require_once __DIR__ . "/../vendor/autoload.php";

$client = ClientBuilder::create()->build();

$params = [
    'index' => 'my_index',
    'id' => 'my_id',
];

$response = $client->delete($params);
print_r($response);
