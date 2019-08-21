<?php
class A{
	static $a=0;
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