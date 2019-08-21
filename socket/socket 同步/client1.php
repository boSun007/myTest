<?php
function debug($msg){
    error($msg,3,'socket.log');
}
$argv[1] = true;
if($argv[1]){
    $socket_client = stream_socket_client('tcp://0.0.0.0:2000', $errno, $errstr,30);
    
    if(!$socket_client){
        die("$errstr ($errno)");
    }else{
        $msg = trim($argv[1]);
    }



}