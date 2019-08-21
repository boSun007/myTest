<?php
$value ="sadjfa444osf1123jojoi123j1oi23j12";
preg_match('/\d+/',$value,$result);
var_dump($result[0]);


$type =["天猫", "京东", "亚马逊", "聚美优品", "蘑菇街"]  ;
foreach(array_rand($type,3)  as $key ){
echo $type[$key].",";
}


 echo "<hr />";

$str = "第011类-灯具空调";

  $patterns = "/\d+/"; //第一种
  //$patterns = "/\d/";  //第二种
  
if (preg_match('|(\d+)|',$str,$r)) echo $r[1];



$array = array(
		0=>[
			0 => 'blue', 1 => 'red', 2 => 'green', 3 => 'red'],
		1=>[
			0 => 'blue', 1 => 'red', 2 => 'green', 3 => 'red'],
																						 )
		;


$key = array_search('green', $array); // $key = 2;

var_dump($key);