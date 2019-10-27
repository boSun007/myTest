<?php

class myClass{
    public static $age=0;

    public  function setAge($age){
        self::$age=$age;
    }

     public static function setNewAge($age){
         static $age;
         self::$age = $age;
     }
     public function getAge(){
         return self::$age;
     }
}



$obj1 = new myClass();
$obj1->setAge(20);
echo myClass::$age;
echo PHP_EOL;
$obj2 = new myClass();
// $obj2->setAge(40);
echo myClass::$age;
echo PHP_EOL;

// myClass::setNewAge(30);
$obj3 = new myClass();
echo $obj3->getAge();
echo PHP_EOL;
echo PHP_EOL;




function myStatic($a,$b,$c){
    static $par;
    static $res;

    if(isset($par) && isset($res) && [$a,$b,$c]=== $par){
        return  'ABC';
    }

    $sum = $a+$b+$c;
    $res = $sum;
    $par=[$a,$b,$c];

    return $sum;    
}

echo myStatic(1,2,3);
echo PHP_EOL;
echo myStatic(1,2,3);
echo PHP_EOL;
echo myStatic(1,2,3);
echo PHP_EOL;
echo myStatic(1,2,3);
echo PHP_EOL;
echo myStatic(1,2,3);


