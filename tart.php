<?php
class Base {
    Public function sayHello(){
        echo "Hello ";
    }
}

trait SayWorld{
    public function sayHello(){
        // parent::sayHello();
        echo 'World!';
        // parent::sayHello();
    }
}

class MyHelloWorld extends Base{
    use SayWorld;   
}

$o = new MyHelloWorld();
$o->sayHello();