<?php

    /**
     * abstract factory
     * Created by PhpStorm.
     * User: Administrator
     * Date: 2019/3/24 0024
     * Time: 16:13
     */
    abstract class CommsManager {
        const APPT=1;
        const TTD=2;
        const CONTACT =3;

        abstract function getHeaderText();

        abstract function getApptEncoder();

        abstract function getTtdEncoder();

        abstract function getContactEncoder();

        abstract function getFooterText();
        abstract function make($flat_int);
    }

    class BloggsCommsManager extends CommsManager {

        public function make($flat_int) {
            // TODO: Implement make() method.
            switch ($flat_int){
                case self::APPT:
                    return new BloggsApptEncoder();
                    break;

            }

        }

        public function getHeaderText() {

            // TODO: Implement getHeaderText() method.
            return "BloggsHeaderText\n";
        }

        public function getFooterText() {

            // TODO: Implement getFooterText() method.
            return "BloggsFooterText\n";
        }

        public function getApptEncoder() {

            // TODO: Implement getApptEncoder() method.
            return "BloggsApptEncoder\n";
        }

        public function getContactEncoder() {

            // TODO: Implement getContactEncoder() method.
            return "BloggsContactEncoder\n";
        }

        public function getTtdEncoder() {

            // TODO: Implement getTtdEncoder() method.
            return "BloggsTtdEncoder\n";
        }
    }













