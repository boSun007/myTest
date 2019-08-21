<?php
class classA {
}
try {
	throw new Exception();
} catch(\Exception $e) {
	var_dump(0);
} finally {
	var_dump(1);
	new classA();
	var_dump(2);
}



