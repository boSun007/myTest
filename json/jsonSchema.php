<?php
$json = '{"firstName":"ban", "lastName":"shan","age":1,"data":{"hobby":"coding"} }';

$a = json_decode($json);

var_dump($a);