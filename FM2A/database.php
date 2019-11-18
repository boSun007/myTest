<?php
namespace FM2A;


use PDO;
use Redis;

class database{
    private static $redis;
    private static $db;

    private function __construct(){
        $config = parse_ini_file('config.ini',true);
        
        $redis = new Redis();
        $redis->pconnect($config['redis']['host'],$config['redis']['port']);
        $redis->select($config['redis']['database']);
        self::$redis = $redis;

        $database =new PDO("sqlsrv:Server={$config['database']['host']};Database={$config['database']['database']}", $config['database']['user'],  $config['database']['pwd']);
        
        

        self::$db = $database;

    }

    public static function getRedis(){
        if(!self::$redis){
            new self();
        }
        

        return self::$redis;

    }

    public static function getDB(){
        if(!self::$db){
            new self();
        }

        return self::$db;
    }
}