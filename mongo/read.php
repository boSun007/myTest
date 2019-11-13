<?php

use MongoDB\Driver\Exception\Exception;
use MongoDB\Driver\Manager;
use MongoDB\Driver\Query;
 
try{
    $manager = new Manager("mongodb://localhost:27017");
    $query = new Query([]);
    

    $rows = $manager->executeQuery("phpbasics.storeCollection",$query);

    foreach($rows as $row){
        echo $row->_id.PHP_EOL;
        print_r($row);
        // echo "$row->_id : $row->title".PHP_EOL;
    }
}catch(Exception $e){
    $filename = basename(__FILE__);
     echo $filename.PHP_EOL;
     echo $e->getMessage();
} 
    