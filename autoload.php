<?php
spl_autoload_register("autoload");

function autoload($class){
	

	$file = str_replace('\\','/',$class).".php";
	include $file;
}
