<?php

use Elasticsearch\ClientBuilder;

require_once __DIR__."/../vendor/autoload.php";

$client = ClientBuilder::create()->build();

echo 'FF';