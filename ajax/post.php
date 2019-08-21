<?php
    /**
     * Created by PhpStorm.
     * User: Administrator
     * Date: 2019/4/9 0009
     * Time: 15:11
     */
//    header("Content-Type:text/plain;charset=utf-8");
//    header("Content-Type:text/xml;charset=utf-8");
//    header("Content-Type:text/html;charset=utf-8");
//    header("Content-Type:application/json;charset=utf-8");
//    header("Content-Type:application/javascript;charset=utf-8");
    $staff =[
        [ 'name'=>'snow1', 'number'=>'001'],
        [ 'name'=>'snow2', 'number'=>'002'],
        [ 'name'=>'snow3', 'number'=>'003'],
    ];
    echo json_encode($staff);
//    print_r($_POST);
//    $a= (object)$staff;
//    print_r($a);
