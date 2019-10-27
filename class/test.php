<?php

class Car{
    const con = 'con';

    public function DmodelStatic()
    {
       return 'static: '.static::DgetModel().PHP_EOL;
    }
    protected function DgetModel()
    {
        echo "DgetModel Been called".PHP_EOL;
    }
}

 
$a = new Car();
echo $a->DmodelStatic(); 
