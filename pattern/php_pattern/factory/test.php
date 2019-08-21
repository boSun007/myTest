<?php
    /**
     * Created by PhpStorm.
     * User: Administrator
     * Date: 2019/2/23 0023
     * Time: 8:59
     */
    include_once "HairFactory.php";
    include_once "MCFactory.php";
    $hairObj = new HairFactory();
    $newObj = $hairObj->getHair("LHair");
    $newObj->draw();

    $person = new MCFactory();
    $person->getBoy()->drawMan();
