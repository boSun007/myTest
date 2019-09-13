<?php

class myClass{
    private const _ABC='abc';
    const ABC = 'ABC';
    private $abc = '$abc';
    private static $_abc = '$_abc';
    private static $obj;

    public static function index($var1,$var2)
    {
        if(!isset($obj)){
            self::$obj = new self($var1,$var2);
        }
        return self::$obj;
    }

    private function __construct($var1,$var2)
    {
        echo 'COOON';
    }

    public function pubFunc($var1,$var2)
    {
        echo 'LLL';
    }

    public static function abc()
    {
        # code...
        self::$_abc='ccc';
        self::$obj->pubFunc(3,7);
    }
    
    public static function fancy(){
        // var_dump(self);
        // return __CLASS__;
        // return static::$_abc;

        
    }
}

// myClass::index(1,2)->pubFunc(3,5);
// myClass::abc();
$a =  myClass::fancy();

var_dump($a);





