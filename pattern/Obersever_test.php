<?php
    /**
     * Created by PhpStorm.
     * User: Administrator
     * Date: 2019/2/21 0021
     * Time: 14:22
     */

    include_once "./class/Observable_Exception.php";
    include_once "./class/Observer_Interface.php";
    include_once "./class/Login_Exception.php";
    include_once "./class/Emailing_Exception.php";

    ObservableException::attach(new Login_Exception());
    $login = new ObservableException();
    $login->notify();
//    ObservableException::attach(new Emailing_Exception(new ObservableException()));
