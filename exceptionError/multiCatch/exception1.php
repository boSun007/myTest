<?php
namespace exceptionError\multiCatch;

class exception1 extends myHandler{

    public function __construct()
    {
        echo 'this is exception1 construct'.PHP_EOL;
        
    }

    public function process()
    {
        echo 'now process exception1'.PHP_EOL;
    }
}