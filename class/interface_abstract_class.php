<?php 
interface myInterface{
	 function abc();
	function def();
}

abstract class myABClass implements myInterface{
	public function __construct(){}
	abstract function abc();
	public function def(){
		echo "EF";
	}
}

class myClass extends myABClass{
	function abc(){
		echo "ABC";
	}
}

$a = new myClass();
echo $a->def();
