<?php
$fruits = array("d"=>"lemon", "a"=>"orange", "b"=>"banana", "c"=>"apple");
ksort($fruits,['b','a','c','d']);
foreach ($fruits as $key => $val) {
    echo "$key = $val\n";
}










error_reporting(E_ALL);
function increment(&$var)
{
    $var+=100;
}

$a = 20;
call_user_func(increment, $a);
echo $a."\n";
