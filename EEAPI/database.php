<?php
namespace EEAPI;


use PDO;
use Redis;

class database{
    private static $redis;
    private static $db;

    private function __construct($configFolder){
        $config = parse_ini_file("$configFolder/config.ini",true);
        
        $redis = new Redis();
        $redis->pconnect($config['redis']['host'],$config['redis']['port']);
        $redis->select($config['redis']['database']);
        self::$redis = $redis;

        $database =new PDO("sqlsrv:Server={$config['database']['host']};Database={$config['database']['database']}", $config['database']['user'],  $config['database']['pwd']);
        
        

        self::$db = $database;

    }

    public static function getRedis($configFolder){
        if(!self::$redis){
            new self($configFolder);
        }
        

        return self::$redis;

    }

    public static function getDB($configFolder){
        if(!self::$db){
            new self($configFolder);
        }

        return self::$db;
    }
}