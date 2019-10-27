<?php
    /**
     * Created by PhpStorm.
     * User: Administrator
     * Date: 2019/3/31 0031
     * Time: 14:02
     */


    abstract class Unit {
        public static $Tstrength =0;
//         function addUnit(Unit $unit){
//           return new \Exception(get_class($this).'this is leaf');
//         }
//         function removeUnit(Unit $unit){
//            return new \Exception(get_class($this).'this is leaf');
//        }
        abstract function bombardStrength();
        function getComposite(){
            return null;
        }
    }