<?php

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

include __DIR__.'/../vendor/autoload.php';

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

// 该连接抽象套接字(socket)连接，并为我们负责协议版本协商和认证等。这里，我们连接到一个rabbitmq代理器在本地机器上-使用localhost。如果我们想在不同的机器上连接到一个代理，我们只需在这里指定它的名称或IP地址。

// 接下来，我们创建一个通道，这是处理事情的大部分API的地方。

// 发送消息前，我们必须声明一个队列为我们发送做准备；然后我们可以向队列发布消息：

$connection = new AMQPStreamConnection($config['rabbitmq']['host'], $config['rabbitmq']['port'],
    $config['rabbitmq']['login'], $config['rabbitmq']['password'], $config['rabbitmq']['vhost']);
$channel = $connection->channel();

//发送方其实不需要设置队列， 不过对于持久化有关，建议执行该行
$channel->queue_declare('hello', false, false, false, false);

$msg = new AMQPMessage('Hello World!');
$channel->basic_publish($msg, '', 'hello');

echo " [x] Sent 'Hello World!'\n";

$channel->close();
$connection->close();