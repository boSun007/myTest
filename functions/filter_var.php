<?php
$a="012we4w5e7w5e5w855eeeww1es";
// echo $var = filter_var((int)$a, FILTER_VALIDATE_INT);

$r = telNumber($a,'GBP');
// var_dump($r);

function telNumber($phone, $country)
	{ 
		// ‘/[\W]/’ matches all the non-alphanumeric characters and replace them with ‘ ‘ from number
        // $phone_to_check = preg_replace( '/[\w+]/', '', $phone);
        // echo $phone_to_check;
        $filtered_phone_number = filter_var($phone,FILTER_SANITIZE_NUMBER_INT);
        echo $filtered_phone_number;
		// var_dump($filtered_phone_number);
		// var_dump($phone);
		// var_dump($phone_to_check);die();
		// Check the lenght of number
		$countries = array(
			'USD' => 10,
			'GBP' => 10
		);
		return ! (strlen($filtered_phone_number) < $countries[$country] || strlen($filtered_phone_number) > 14);
	}