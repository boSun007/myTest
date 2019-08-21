<?php
    /**
     * Created by PhpStorm.
     * User: Administrator
     * Date: 2019/3/21 0021
     * Time: 12:50
     */

use book\book;
use product\product;
    include_once "autoload.php";
//    include_once "book/book.php";
    function getName(product $product){
        return $product->getName();
    }

    $book = new book();
    $product = new product();
     $car22 = new car();
//     echo $car->getName();
//    echo $product->getName();
//    echo $book->getName();
//    echo getName($car);

var_dump($car instanceof product);
var_dump(get_class($car22));





