<?php
abstract class baseAgent{
	abstract function PrintPage();
}

class ieAgent extends baseAgent{
	function PrintPage(){
		return "IE";
	}
}

class otherAgent extends baseAgent{
	function PrintPage(){
		return "Other";
		}
}


class Browser{
	public function call(baseAgent $object){
		return $object->PrintPage();
	}
}

$browser = new Browser();
echo $browser->call(new ieAgent());
echo $browser->call(new otherAgent());



