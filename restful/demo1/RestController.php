<?php
require_once("SiteRestHandler.php");

$view = "";
if(isset($_GET["view"])){
	$view = $_GET["view"];
}

/*
* RESTful Service ¿ØÖÆÆ÷
*URL Ó³Éä
*/
switch($view){
	case "all":
		//process Rest RUL /site/list/
		$siteRestHandler = new SiteRestHandler();
		$siteRestHandler->getAllSites();
	break;

	case "single":
		//process REST URL /site/show/<id>/
		$siteRestHandler = new SiteRestHandler();
		$siteRestHandler->getSite($_GET['id']);
		break;

	case "":
		//404
	break;
}

?>