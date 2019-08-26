<?php

use exceptionError\exceptionHandler\exception1;
use exceptionError\exceptionHandler\exception2;

include_once "../../autoload.php";


try{
    // throw new exception1();
    throw new exception2();
    // throw new Exception('la la la ');

}catch(exception1 $e1){
    $e1->process();
}catch(exception2 $e2){
    $e2->process();

}catch(Exception $e){
    echo $e->getMessage();
}
