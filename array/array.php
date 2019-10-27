
<?php
$arr = array();
$processor =[1,3,5,7,9];
for($i=0;$i<10;$i++){
	$arr['a'][]=$processor;

}

var_dump($arr);

exit;

$processor =
[
	'a1'=>[1,3,5,7,9],
	'b1'=>[2,4,6,8,10],
];
//$processor =[1,3,5,7,9];
print_r(array_keys($processor,2));
exit;





$arr = ['a','b','c','d','e','f','g','h','i','j','k'];
$brr = array_slice($arr,0,3);
var_dump($brr);

$arrayold = array("a" => "green", "b" => "brown", "c" => "blue", "e"=>"red");
$arraynew = array("a" => "green2", "b" => "brown2", "c" => "blue", "e"=>"red");
$resultold = array_diff_assoc($arrayold, $arraynew);
$resultnew = array_diff_assoc($arraynew, $arrayold);
print_r($resultold);
echo "<hr />";
print_r($resultnew);