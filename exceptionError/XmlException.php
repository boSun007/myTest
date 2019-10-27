<?php
    /**
     * Created by PhpStorm.
     * User: Administrator
     * Date: 2019/3/20 0020
     * Time: 12:57
     */

    class XmlException extends Exception {

        private $error;

        public function __construct(LibXmlError $error) {

            $shortfile = basename($error->file);
            $msg = "[{$shortfile}, line {$error->line}, col {$error->column}] {$error->message}";
            $this->error = $error;
            parent::__construct($msg, $error->code);
        }

        function getLibXmlError(){
            return $this->error;
        }
    }