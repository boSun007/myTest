<?php
set_error_handler("handleError");

set_exception_handler('handleException');

function handleError($no,$str,$file,$line,$msg){
    echo $no;

}

function handleException($exception){
    echo 'this is my exception'. $exception;
}

echo 2%0;