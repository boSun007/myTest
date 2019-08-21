<?php
    /**
     * Created by PhpStorm.
     * User: Administrator
     * Date: 2019/2/21 0021
     * Time: 14:49
     */

    include_once "observerClass.php";

    $ob1 = new main(new observer1());
    $ob1->observe();
    $ob2 = new main(new observer2());
    $ob2->observe();

    $ob3 = new main(new observer3());
    $ob3->observe();