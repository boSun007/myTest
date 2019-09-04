<?php
class A{
	static $a=0;
	public static function myself(){
		$a= new static();
		$b = new self();
		var_dump($a);
		var_dump($b);
		return $a===$b;
	}
	static public function aa(){
		self::$a++;
		return self::class;
	}
	static public function bb(){
		self::$a++;
		return self::class;
	}
	static public function cc(){
	echo 		self::$a;
	}
		static public function dd(){
	echo 		self::$a=7;
	}
	static public function obj(){
		return new A();
	}
	public function abc(){
		echo self::$a;
	}
}
// $self = A::myself();

// var_dump($self);exit;


A::aa()::bb()::cc();
A::aa()::bb()::dd();
A::aa()::bb()::cc();
A::aa()::bb()::dd();
A::obj()->abc();			

echo PHP_EOL;

class B{
	public static $b=1;
	public function test(){
		echo static::$b;
	}
}

class C extends B{
	public static $b=2;
}
$m = new C();
$m->test();

echo PHP_EOL;

function t() {
	static $i = 0;
	static $i = 9;
	//  $i = 0;
	$i++;
	echo $i;
	}
	
	t();
	t();
	t();

	class Blog {
		public static $template = array('content' => 'doodle');
		public static $template2 = array('content' => 'doodle');
		public function abc(){

		}

	}
	
	Blog::$template['content'] = 'bubble';
	
	$class = 'Blog';
	$action = 'content';
	$values = get_class_vars($class);
	$a = get_class_methods($class);
	var_dump($a);exit;
	VAR_DUMP($values);exit;
	echo $values['template'][$action];