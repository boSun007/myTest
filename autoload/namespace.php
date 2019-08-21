<?php
namespace a;
class a{
	function __construct(){
		echo "THIS IS A";
	}
}

namespace b;
class b{
	function __construct(){
		echo "THIS IS BO";
	}
}

namespace c;
use a\a;
$a = new a();
