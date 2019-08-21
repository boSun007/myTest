<?php
class socket
{
    private $host = '0.0.0.0';
    private $port = 9999;

    public function __construct($port = 9999)
    {
        $this->port = $port;
        $this->startSocket();
    }

    private function startSocket()
    {
        $listen_socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        socket_bind($listen_socket, $this->host, $this->port);
        socket_listen($listen_socket);


        $client = [$listen_socket];
        $write = [];
        $ecp = [];

        while (true) {
            $read = $client;
            if (socket_select($read, $write, $ecp, null) > 0) {
                if (in_array($listen_socket, $read)) {
                    $client_socket = socket_accept($listen_socket);
                    $client[] = $client_socket;
                    $key = array_search($listen_socket, $read);
                    unset($read[$key]);
                }

                if(count($read) >0){
                    foreach($read as $socket_item){
                        $content = socket_read($socket_item,2048);
                         foreach($client as $client_socket){
                             if($client_socket != $listen_socket && $client_socket != $socket_item){
                                 socket_write($client_socket,$content,strlen($content));
                             }
                         }
                    }
                }
            }else{
                continue;
            }
        }
    }
}

new socket();