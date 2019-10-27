<?php
    /**
     * Created by PhpStorm.
     * User: Administrator
     * Date: 2019/2/21 0021
     * Time: 14:41
     */

    class main{
        private $_observer;
        public function __construct(observer $observer) {
            $this->_observer = $observer;
        }

        public function observe(){
            $this->_observer->result();
        }
    }

    interface  observer{
        public function result();
    }


    class observer1 implements observer{
        public function result() {
            // TODO: Implement result() method.
            echo "this is observer1";
        }

    }
    class observer2 implements observer{
        public function result() {
            // TODO: Implement result() method.
            echo "this is observer2";
        }
    }

    class observer3 implements observer{
        public function result() {
            // TODO: Implement result() method.
            echo "this is observer3";
        }
    }