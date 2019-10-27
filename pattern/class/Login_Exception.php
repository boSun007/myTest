<?php
    /**
     * Created by PhpStorm.
     * User: Administrator
     * Date: 2019/2/21 0021
     * Time: 14:08
     */
include_once "Observer_Interface.php";
    class Login_Exception implements Observer_Interface {
        protected $_filename = "E:/abc/login.log";
        public function __construct($filename="E:/abc/login.log") {
            if($filename !==null && is_string($filename)){
                $this->_filename=$filename;
            }
        }

        public function update(ObservableException $e) {
            // TODO: Implement update() method.
            $message ="TIME: ".date("Y-m-d H:i:s").PHP_EOL;
            $message .="MSG: ".$e->getMessage().PHP_EOL;
            $message .="TRACE: ".$e->getTraceAsString()>PHP_EOL;
            $message .="FILE: ".$e->getFile();
            $message .="Line: ".$e->getLine();
            error_log($message,3,$this->_filename);
        }
    }