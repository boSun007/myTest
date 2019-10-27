<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019-03-15
 * Time: 11:34
 */

class abc{
    public $arr=array();

    public function __construct()
    {
        $this->arr=['a'=>1,
            'b'=>2];
    }

}


function myFunc(abc $abc){
    echo $abc->arr['b'];
}

$a = new abc();
myFunc($a);




