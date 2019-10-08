<?php
// $name="why";//声明变量$name,并初始化
function echoName1()
{
//在函数echoName1()里使用global来声明$name
global  $name;
$name ='AABBCC';
echo "the first name is ".$name.PHP_EOL;
}
function echoName2()
{
    //在函数echoName2()里没有使用global来声明$name
    echo "the second name is ".$name."<br>";
}
// echo $name;
echo PHP_EOL;
echoName1();
echo $name;
echo PHP_EOL;
// echoName2();

$abc='A';
$aBc= 'B';
 echo $aBc;
 echo $abc;

