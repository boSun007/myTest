<?php
set_time_limit(0);


$ip ="127.0.0.1";
$port=1935;


if(($sock = socket_create(AF_INET,SOCK_STREAM, SOL_TCP))<0){
    echo "socket_creaate() failure, Reason: ".socket_strerror($sock)."\n";
}

if(($ret = socket_bind($sock, $ip, $port))<0){
    echo "socket_bind() fail, Reason: ".socket_strerror($ret)."\n";
}

if(($ret = socket_listen($sock,4))<0){
    echo "socket_listen() fail, Reason: ".socket_strerror($ret)."\n";
}

$count =0;

do {
    # code...
    if(($msgsock = socket_accept($sock))<0){
        echo "socket_accpet() fialed: reason: ".socket_strerror($msgsock)."\n";
        break;
    }else{
       

        echo "so success\n";
        $buf = socket_read($msgsock,8192);
        $talkback = "message received is : $buf\n";
        echo $talkback;
        $i=0;
        while($i<10){
            $msg = "test success!\n".$i;
            socket_write($msgsock,$msg,strlen($msg)); 
            $i++;            
            sleep(5);
        }


        if(++$count >=5){
            break;
        };
    }
    socket_close($msgsock);
    
} while (true);







