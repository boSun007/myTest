<?php
set_error_handler("handleError");



function handleError($no,$str,$file,$line,$msg){
    echo $no;

}


echo $a;