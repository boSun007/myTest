<?php

use exceptionError\multiCatch\exception1;
use exceptionError\multiCatch\exception2;


// echo dirname(__FILE__);

include dirname(__FILE__).'/../../'."autoload.php";



try{
    throw new exception1();
    // throw new exception2();
    // throw new Exception('la la la ');

}catch(exception1 $e1){
    $e1->process();
    // throw new exception2();
    try{
        throw new exception2();

    }catch(exception2 $e2){
        $e2->process();
    
    }
}catch(exception2 $e2){
    $e2->process();

}catch(Exception $e){
    echo $e->getMessage();
}
