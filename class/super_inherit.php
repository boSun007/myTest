<?php
class grand{
    protected function grand_func1(){
        echo __CLASS__;
    }

}

class fathe extends grand{
    protected function fathe_func1(){
        echo __CLASS__;
    }
    
}

class son extends fathe{
    public function son_func1(){
        echo __CLASS__;
    }
    
}


$son = new son();
echo $son->fathe_func1();