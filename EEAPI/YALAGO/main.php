<?php
include __DIR__ . '/../../autoload.php';

use EEAPI\YALAGO\getEstablishments;



$obj = new getEstablishments();

echo $obj->getEstablishmentsList();


var_dump($res);