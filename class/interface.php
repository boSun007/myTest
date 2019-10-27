<?php
interface a{
	const b="ABC-BBB";
}
echo a::b;

class c implements a{
	function c1(){
		echo self::b;
	}
}


$c = new c();
$c->c1();