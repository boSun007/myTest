<?php
    /**
     * Created by PhpStorm.
     * User: Administrator
     * Date: 2019/2/21 0021
     * Time: 14:02
     */

    class ObservableException extends Exception {
        public static $_observers=array();

        public static function attach(Observer_Interface $observer){
            self::$_observers[] = $observer;
        }

        public function __construct($message = "", $code = 0, Throwable $previous = null) {

            parent::__construct($message, $code, $previous);
            $this->notify();
        }

        public function notify(){
            foreach(self::$_observers as $observer){
                $observer->update($this);
            }
        }
    }