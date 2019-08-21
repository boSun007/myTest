<?php
    /**
     * Created by PhpStorm.
     * User: Administrator
     * Date: 2019/2/23 0023
     * Time: 9:07
     */
    include_once "hair.php";
    include_once "LHair.php";
    include_once "RHair.php";
    class HairFactory {

        public function getHair($hairType) {

            switch ($hairType) {
                case "LHair":
                    return new LHair();
                    break;
                case "RHair":
                    return new RHair();
                    break;
                default:
                    return "NOTHING";
                    break;
            }
        }
    }