<?php
namespace exceptionError\exceptionHandler;

class exception2 extends myHandler{

    public function __construct()
    {
        echo 'this is exception2 construct'.PHP_EOL;
        
    }

    public function process()
    {
        echo 'now process exceptione 2'.PHP_EOL;
    }
}