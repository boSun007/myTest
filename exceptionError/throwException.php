<?php
    /**
     * Created by PhpStorm.
     * User: Administrator
     * Date: 2019/3/20 0020
     * Time: 13:49
     */

    function checkNum($num){
        if(1/$num){
            throw new \Exception("hhh");
        }else{
            throw new \Exception("OOO");
        }
    }
    set_error_handler("abc");
    function abc(){

        throw new \Exception("OJIOJ");
    }


    try{
        checkNum(0);
    }catch (\Exception $e){
        echo $e->getMessage();
    }


    echo "aaa";
    throw new Exception('lala lala');
     echo 'BBBBC';