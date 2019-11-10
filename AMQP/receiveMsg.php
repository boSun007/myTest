<?php


include __DIR__.'/../vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
$config = [
    'vendor' => [
        'path' => dirname(dirname(__DIR__)) . '/vendor'
    ],
    'rabbitmq' => [
        'host' => '127.0.0.1',
        'port' => '15672',
        'login' => '',
        'password' => '',
        'vhost' => '/'
    ]
];


$connection = new AMQPStreamConnection($config['rabbitmq']['host'], $config['rabbitmq']['port'],
    $config['rabbitmq']['login'], $config['rabbitmq']['password'], $config['rabbitmq']['vhost']);
$channel = $connection->channel();

$channel->queue_declare('hello', false, false, false, false);
 
echo ' [*] Waiting for messages. To exit press CTRL+C', "\n";

$callback = function($msg) {
    echo " [x] Received ", $msg->body, "\n";
};

$channel->basic_consume('hello', '', false, true, false, false, $callback);

while(count($channel->callbacks)) {
    $channel->wait();
}

$channel->close();
$connection->close();
?>