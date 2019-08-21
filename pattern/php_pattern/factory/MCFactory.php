<?php
    /**
     * Created by PhpStorm.
     * User: Administrator
     * Date: 2019/2/23 0023
     * Time: 10:00
     */
include_once "PersonFactory.php";
include_once "MCBoy.php";
include_once "MCGril.php";
    class MCFactory implements PersonFactory {
        public function getBoy() {
            // TODO: Implement getBoy() method.
            return new MCBoy();
        }

        public function getGirl() {
            // TODO: Implement getGirl() method.
            return new MCGril();
        }
    }