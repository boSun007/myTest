<?php
abstract class F{
	public function fa(){
		return $this->anyf();
	}
}

class c extends F {
	private const c_property="ccfv";
	protected function anyf(){
		return self::c_property;
	}
}

class d extends F {
	private const c_property="ddfv";
	protected function anyf(){
		return self::c_property;
	}
	public function num(float $a){
		echo $a;
	}
}

$c = new c();
echo $c->fa().PHP_EOL;
$d =new d();
echo $d->fa().PHP_EOL;
$num = 123;
$d->num($num);