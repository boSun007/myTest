<?php
namespace mongo\log_test;

use mysqli;

class mysqlClass{
    private static $obj;


    private function __construct(){
        $config = \parse_ini_file(__DIR__.'/config.ini', true);
        
        $config = $config['mysql'];

        $mysql = new mysqli($config['host'],$config['user'],$config['password'],$config['database'],$config['port'],$config['socket']);
        $mysql->set_charset($config['charset']);
        $mysql->options(MYSQLI_OPT_INT_AND_FLOAT_NATIVE,true);
        // mysqli_options($this->conn,MYSQLI_OPT_INT_AND_FLOAT_NATIVE,true);
        
        self::$obj = $mysql;
        
    
    }

    public static function gi(){
        if(!self::$obj){
            new self();
        }
        return self::$obj;
    }
    
}