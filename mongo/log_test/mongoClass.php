<?php
namespace mongo\log_test;

use MongoDB\Driver\Manager;

class mongoClass{
    private static $obj;
    public static $database;
    public static $collections;

    private function __construct(){
        $config = \parse_ini_file(__DIR__.'/config.ini', true);
        
        $config = $config['mongo'];
        self::$obj = new Manager($config['host']);
        self::$collections = $config['collection'];
        self::$database = $config['database'];

    }

    public static function gi(){
        if(!self::$obj){
            new self();
        }
        return self::$obj;
    }
}