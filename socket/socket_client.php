<?php
error_reporting(E_ALL);
set_time_limit(0);
// echo "<h2>TCP/IP Connection</h2>\n";

$port = 1935;
$ip = "127.0.0.1";

$socket = socket_create(AF_INET,SOCK_STREAM, SOL_TCP);
if($socket <0 ){
    echo "socket_create() failed: reason ".socket_strerror($socket)."\n";
}else{
    // echo "OK.\n";
}

// echo "try to connect ".$ip." Port:".$port."\n";
$result = socket_connect($socket,$ip,$port);

if($result < 0){
    // echo "socket_connect() failed. \Reason: ($result) ".socket_strerror($result)."\n";
}else{
    // echo "connection OK \n";
}


$in = "Ho\r\n";
$in .= "first blood\r\n";
$out ="";

if(!socket_write($socket,$in,strlen($in))){
    // echo "socket_write() failed, reason: ".socket_strerror($socket)."\n";
}else{
    echo "message successfully sent to server! \n";
    // echo "message is: <font color='red'>$in</font><br />";
}

while($out = socket_read($socket,8192)){
    // echo "get message form server success\n";
    // echo "received message is:$out";
    echo $out;
}

// echo "shut down Socket....\n";
socket_close($socket);
// echo "shut down completely\n";



