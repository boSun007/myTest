<?php
//QUEST:
$contracts =[
			3=>[1,3],
			1=>[2,4,6,8],
			5=>[5,11],
			4=>[7,9],
			];

$carts1 = [3=>1,4=>2,5=>3,6=>4,7=>5];

//TARGET:
$result = [
		3=>[3=>1,5=>3],
		1=>[4=>2,6=>4],
		5=>[7=>5]
		];

//SOLUTION: FIXED
foreach($contracts as $key=> $val){
	if($intersect = array_intersect($carts1,$val)){
		$arr[$key] = $intersect;
	}
}
var_dump($arr);

$contracts =[
			1=>[2,4,6,8],
			3=>[1,3],
			4=>[7,9],
			5=>[5,11],
			];

$carts1 = [1,2,3,4,5];


var_dump(array_intersect($carts1,$carts2));
$newArr = array();
foreach($contracts as $key=>$contract){
		$newArr[$key]=array_intersect($carts1,$contract);
}
var_dump($newArr);


?>

TARGET: [contract_id=>[cart_ids...]];
array([
		1=>[2,4],
		3=>[1,3],
		5=>[5]
		]);
