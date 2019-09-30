<?php
class Car{
    const con = 'CCAARR';

    public static  function modelSelf()
    {
        echo 'self:'. self::con.PHP_EOL;
        echo 'self:' .self::getModel().PHP_EOL;
    }
    public static  function modelStatic()
    {
        echo 'static:'. static::con.PHP_EOL;
        echo 'static: '. static::getModel().PHP_EOL;
    }
    protected static function getModel()
    {
        echo "i am a car";
    }

    public function DmodelStatic()
    {
        echo 'static: '.static::con.PHP_EOL;
        echo 'static: '.static::DgetModel().PHP_EOL;
    }
    public function DmodelSelf()
    {
        self::DgetModel();
    }
    protected function DgetModel()
    {
        echo "D i am a DCARD";
    }
}

class Mercedes extends Car{
    const con = 'MMEERR';
    protected static function getModel(){
        echo 'i am a Merc';
    }
    public function DgetModel()
    {
        echo "i am a DMerc";
    }
}

$a = new Car();
echo 'new Car -> DmodelStatic';
$a->DmodelStatic();
echo 'new Car -> DmodelSelf';
$a->DmodelSelf();

$m = new Mercedes();

echo 'new Mercedes -> DmodelStatic';
$m->DmodelStatic();
echo 'new Mercedes -> DmodelSelf';
$m->DmodelSelf();

echo 'Car::modelSelf()';
Car::modelSelf();
echo 'Car::modelStatic()';
Car::modelStatic();

echo 'Mercedes::modelSelf()';
Mercedes::modelSelf();
echo 'Mercedes::modelStatic()';
Mercedes::modelStatic();

phpinfo();