<?php
    /**
     * Created by PhpStorm.
     * User: Administrator
     * Date: 2019/3/21 0021
     * Time: 12:48
     */
namespace book;
use product\product;
//    class book extends product {
    class book extends product{
        public function getName(){
            return "THIS IS BOOK NAME";
        }
    }
