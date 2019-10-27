<?php
	class a {
		public function __construct()
		{
			echo 'A CONSTRUCT'.PHP_EOL;
		}
		public function test() {
			echo 'aaa<br />';
			$this->tests();
		}
		
		public function tests() {
			echo 'bbb';
		}
	}
	
	class b extends a {
		
		public function __construct()
		{
			echo 'B CONSTRUCT'.PHP_EOL;
			parent::__construct();
		}


		public function tests() {
			echo 'ccc';
		}
	}
	
	$b = new b();
	$b->test();
	// echo $a;
