<?php

function abc($a){
    echo $a."---";
    if($a++<10){
    echo $a."<br />";
        abc($a);
    }else{
        echo "<hr />";
        return $a;
    }
}

function d(){
    echo abc()+6;
}
function c(){
    static $c=0;
    static $c=1;
    echo $c;
}
abc(8);
//echo d();
//c();

?>


<hr />

张三在年初给油卡充值了20000元，已知张三每个月都会加油4次，费用是350*4元。
张三加油每满10次，油站就会打一次8折，并返现1折。问：张三这张卡第几次加油以后要再次充值？每次加油以后油卡余额多少？
<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019-03-15
 * Time: 11:47
 */
$card = 20000;
$fee =350*4;
$cost = 0;

function oil($card,$times=0){
    $times++;
    if($times%10!=0){
        $card =$card-350;
    }else{
        $card = $card-350*0.8+350*0.1;
    }
    echo $card."--".$times."<br />";
    if($card<350){
        echo $times;
    }else{
        oil($card,$times);
    }
}
oil($card);
?>
小王父母在开学时给他存了20000块钱生活费，已知小王每个月都会在银行计息以后取钱1500元。假设活期月利率是0.32%。
那么小王每次取钱以后的余额是多少？小王第几次取完？<br />
<?php
$saving = 20000;
function myMoney($total,$times=0){
    $times++;

    $total+=$total*0.0032;

    if($total<1500){
        echo $total."---".$times."<br />";
    }else{
        $total-=1500;
        myMoney($total,$times);
    }
}

myMoney($saving);
