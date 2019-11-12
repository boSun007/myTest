<?php
require_once __DIR__ . "/../vendor/autoload.php";

use Elasticsearch\ClientBuilder;


$client = ClientBuilder::create()->build();

$params = [
    'index' => 'my_index',
    'id' => 'my_id',
];
$response = $client->get($params);
print_r($response);
