<?php
spl_autoload_register("autoload");

function autoload($class){
	
	$dir = __DIR__;
	$file = str_replace('/','\\',$class).".php";
	// echo $dir.'\\'.$file;exit;
	include  $dir.'\\'.$file;
}
