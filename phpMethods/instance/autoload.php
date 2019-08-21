<?php
    /**
     * Created by PhpStorm.
     * User: Administrator
     * Date: 2019/3/21 0021
     * Time: 12:48
     */

    spl_autoload_register("autoload");

    function autoload($class){
        $file = str_replace("\\","/",$class).".php";
        include_once($file);
    }