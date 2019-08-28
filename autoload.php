<?php
spl_autoload_register("autoload");

function autoload($class){
	

	$file = str_replace('\\','/',$class).".php";
	// echo dirname(__FILE__).'/'.$file;;exit;
	include  dirname(__FILE__).'/'.$file;
}
