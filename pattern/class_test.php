<?php
    /**
     * Created by PhpStorm.
     * User: Administrator
     * Date: 2019/2/21 0021
     * Time: 15:04
     */

    class MyTest{
        protected $_myArray=array();

        public function setArray($value) {
            array_push($this->_myArray,$value);
        }

        public function getArray(){
            return $this->_myArray;
        }
    }


    $ob = new MyTest();
    $ob->setArray("A1");
    $ob->setArray("A2");
    $ob->setArray("A3");
    $ob->setArray("A4");
    $ob->setArray("A5");
    $arr = $ob->getArray();
    var_dump($arr);