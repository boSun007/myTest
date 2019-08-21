<?php


function myFunction($p1,$p2){
    echo $p1+$p2;
}

//myFunction(2,5);

call_user_func_array('myFunction',[2,4]);
call_user_func('myFunction',2,4);










function f1($arg1,$arg2)
{
	echo __FUNCTION__.'exec,the args is:'.$arg1.' '.$arg2;
	echo "<br/>";
  
  }
call_user_func('f1','han','wen');

call_user_func_array('f1',array('han','wen'));

class A
{
	public $name;
	function show($arg1){
		echo 'the arg is: '.$arg1.'<br />';
		echo 'my name is: '.$this->name.'<br />';
	}

	function show1($arg1,$arg2){
		echo __METHOD__.'exec, the args is:'.$arg1.'----'.$arg2.'<br />';
	}

	public static function show2($arg1,$arg2){
		echo __METHOD__.'of class A exec, the args is: '.$arg1.'----'.$arg2.'<br />';
	}
}

$a = new A;
$a->name = 'wen';
call_user_func_array(array($a,'show'),array('han'));
call_user_func_array(array($a,'show1'),array('han123','wen456'));
//call_user_func_array(array($a,'show2'),array('arrrg1','arrrrg2'));//������Ϊ$a�Ƕ������ַ���
call_user_func_array(array('A','show2'),array('arrrg1','arrrrg2'));

class MyClass3
{
	public static function myCallBack($arg1,$arg2){
		echo 'arg1='.$arg1.'----arg2='.$arg2.'<br />';
	}
}

$className = 'MyClass3';
$functionName = 'myCallBack';
$params = array('argggg1','arrrg2');
call_user_func_array(array($className,$functionName),$params);

// class MyClass
// {
// 	private $name='abc';
// 	public function fnCallBack ($arg1='default msg1', $arg2="default msg2"){
// 		echo 'object name:'.$this->name;
// 		echo 'arg1='.$arg1.'----arg2='.$arg2.'<br />';
// 	}
// }
// $myobj = new MyClass();
// $fnName = "fnCallBack";
// $params = array( 'hello' , 'world' );
// //���������Ĺ���
// function anonymous()
// {
// 	global $myobj;
// 	global $fnName;
// 	global $params;
// 	$myobj->$fnName( $params[0] , $params[1] );
// }
// anonymous();

class MyClass2
{
	private $name = "abc";
	public function myFunc($arg1='arg1',$arg2='arg2'){
		echo 'object2222 name:'.$this->name.'<br />arg1:'.$arg1.'----arg2:'.$arg2.'<br />';

	}
}

$myObj = new MyClass2();
$myFunc ="myFunc";
$params = array('hweooo1','worrrld');


function anonymous(){
	global $myObj;
	global $myFunc;
	global $params;
	
	$myObj->myFunc($params[0],$params[1]);
}

anonymous();



