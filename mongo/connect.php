<?php

use MongoDB\Driver\Command;
use MongoDB\Driver\Manager;
use MongoDB\Driver\Query;

$m = new Manager("mongodb://localhost:27017");

var_dump($m);