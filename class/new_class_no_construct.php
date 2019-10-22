<?php
class myClass{
    public function get(){
        return __FUNCTION__;
    }
}

$a = new myClass('abc');
var_dump($a);