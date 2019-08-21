<?php
    /**
     * Created by PhpStorm.
     * User: Administrator
     * Date: 2019/2/21 0021
     * Time: 13:02
     */

    register_shutdown_function("myFataFunc");
    set_error_handler("myErrorHandler");
    function myErrorHandler(){
        echo "NOTHING";
        throw new \Exception("nnnnnnn");
    }
    function myFataFunc(){
        echo "ABC";


    }

    try{
    $arr = [];
    echo "ABB";
    echo $arr[1];

//        test();
    }catch (\Exception $e){
        echo "CCC";
        echo "<hr />".$e->getMessage();
    }
//    settype($num,"ABC");
    echo "DDD";