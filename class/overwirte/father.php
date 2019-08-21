<?php
	class a {
		public function test() {
			echo 'aaa<br />';
			$this->tests();
		}
		
		public function tests() {
			echo 'bbb';
		}
	}
	
	class b extends a {
		public function tests() {
			echo 'ccc';
		}
	}
	
	$b = new a();
	$b->test();
