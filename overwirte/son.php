<?Php

 class FatherClass
{
    public function abc()  {
      echo "LLL";
    }
    public function def(){
        echo "def";
        $this->abc(); //这里我想调用sonClass中的abc(), 应该怎么写?
    }
}

class sonClass extends FatherClass{

    public function abc() {
        echo "DEI"; 
    }

    public function def(){
        $this->def();
    }
}



$obj = new FatherClass();

$obj->def();
