<?php
$a='';
var_dump(isset($a));
die();

$postcode='b7w13rd';
$country = "GBP";
$country = "789";


$phone='';
$phone = str_replace('+','',$phone);
$phone = str_replace('-','',$phone);
$phone = str_replace('(','',$phone);
$phone = str_replace(')','',$phone);



// echo  (int)$country == $country;
// die();


$phone='x123abcNtTWi(asd easdfe  )ndo-es';
$pattern = '/\(.*?\)/';
$match = preg_replace($pattern,'',$phone);

var_dump($match);

die();



$preg= '/[A-Za-z]*/';
$string= 'a2223888';
if(preg_match($preg,$string)){
echo '包含字母';
}else{
echo '不包含字母';
}



die();
$phone='07 2 2  2 5 5 5  555';
$pattern= '/[0-9\-+]*/';
// $phone = str_replace('+','',$phone);
// $string = PREG_REPLACE("/[^0-9]/i", '', $buffer);


$match = preg_match($pattern,$phone);

var_dump($match);
die();

if ($match != false) {
    echo 'We have a valid phone number';
} else {
	echo 'dont';
    // We have an invalid phone number
}




die();




$r = postcode($postcode,$country);
var_dump($r);

 function postcode($postcode, $country)
	{
		$countries = array(
			'USD' => '/^[0-9]{5}(-[0-9]{4})?$/',
			'GBP' => '/^\s*(([A-Z]{1,2})[0-9][0-9A-Z]?)\s*(([0-9])[A-Z]{2})\s*$/'
		);
		return preg_match($countries[$country], strtoupper($postcode));
	}


	$value ="sadjfa444osf1123jojoi123j1oi23j12";
preg_match('/\d+/',$value,$result);
var_dump($result[0]);


$type =["天猫", "京东", "亚马逊", "聚美优品", "蘑菇街"]  ;
foreach(array_rand($type,3)  as $key ){
echo $type[$key].",";
}


 echo PHP_EOL;

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