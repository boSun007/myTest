<?php
    /**
     * Created by PhpStorm.
     * User: Administrator
     * Date: 2019/2/21 0021
     * Time: 14:18
     */
    include_once "Observer_Interface.php";
    class Emailing_Exception implements Observer_Interface {
        protected $_filename = "E:/abc/email.log";
        public function __construct($filename="E:/abc/email.log") {
            if($filename){
                $this->_filename = $filename;
            }
        }

        public function update(ObservableException $e) {
            // TODO: Implement update() method.
            $message ="TIME: ".date("Y-m-d H:i:s").PHP_EOL;
            $message .="file: ".$e->getFile();
            $message .="line: ".$e->getLine();

            error_log($message,3,$this->_filename);
        }
    }