<?php
    /**
     * Created by PhpStorm.
     * User: Administrator
     * Date: 2019/2/21 0021
     * Time: 14:03
     */

    interface   Observer_Interface {
        public function update(ObservableException $e);
    }