<?php
function a($str){
set_error_handler(function($errno, $errstr, $errfile, $errline, array $errcontext) {
    //error was suppressed with the @-operator
     if (0 === error_reporting()) {
     return false;
     }
    
     throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
    });

try{ 
    $xml = simplexml_load_string($str);
    var_dump($xml);
}catch(Exception $e){
    echo 'AAAAA';
    echo $e->getMessage();
    return 'AAA';

}
}

$str ='<abc>sddf</ac>';
$str ='';

a($str);
echo 'XXXXX';