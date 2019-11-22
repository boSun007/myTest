<?php

$GO=array();


a();
// global $GO;
echo $GO['abc'];


function a(){
    global $GO;
    $GO['abc'] ='ABC';

    
}


