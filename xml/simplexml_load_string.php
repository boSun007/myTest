<?php

$a='abc';
try{
    var_dump(simplexml_load_string($a));
}catch(Exception $e){
    echo $e->getMessage();
}

echo 'xxxxx';
