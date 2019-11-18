<?php
$today = '2020-01-03';
echo $lastday = date("Y-m-d", strtotime($today . " +2 day "));
die();

$day = "2019-11-08 10:27:35";

$date = new DateTime($day);
$week = $date->format('W');
echo $date->format('w');
die();



$Date_1 = "2020-04-01";
$Date_2 = "2020-03-11";
$d1 = strtotime($Date_1);
$d2 = strtotime($Date_2);
$Days = round(($d2 - $d1) / 3600 / 24);
echo "今天与2008年10月11日相差" . $Days . "天";
die();





$firstday = date("Y-m-01", strtotime(date("Y-m-d")));
echo $firstday;
echo PHP_EOL;
$lastday = date("Y-m-d", strtotime(date("Y-m-d") . " +2 day "));
echo $lastday;
echo PHP_EOL;
die();
//今天与2008年9月9日相差多少天
$Date_1 = date("Y-m-d");
$Date_2 = "2019-03-24";
$d1 = strtotime($Date_1);
$d2 = strtotime($Date_2);
$Days = round(($d2 - $d1) / 3600 / 24);
echo "今天与2008年10月11日相差" . $Days . "天";
?>

<?php
// $days=4567;
// $date="1900-01-01";
// $datetime= new DateTime($date, new DateTimeZone("PRC"));  
// echo $a  = $datetime->format('Y-m-d');  
// var_dump(date("Y-m-d",$a));
// echo(date("M-d-Y",mktime(0,0,0,1,1,1900))); 

$days = 4;
$date = "1000-01-01";
echo (int) $date;
$param_arr = getopt("-:-");
var_dump($param_arr);

echo "<hr />";
$a = "4356127asdfas1561";
echo "AAAA<hr />";
var_dump($a);
echo "<hr />";
var_dump(is_numeric($a));



echo newDate("1991-01-01", 10);

function newDate($oldDate, $days, $timezone = "PRC")
{
    $dateTime = new DateTime($oldDate, new DateTimeZone($timezone));
    $unixTime = $dateTime->format('U') + $days * 24 * 60 * 60;
    $dateTime = new DateTime("@$unixTime"); //DateTime类的bug，加入@可以将Unix时间戳作为参数传入
    $dateTime->setTimezone(new DateTimeZone($timezone));
    return $dateTime->format("Y-m-d");
}










//1、Unix时间戳转日期
function unixtime_to_date($unixtime, $timezone = 'PRC')
{
    $datetime = new DateTime("@$unixtime"); //DateTime类的bug，加入@可以将Unix时间戳作为参数传入
    $datetime->setTimezone(new DateTimeZone($timezone));
    return $datetime->format("Y-m-d");
}

//2、日期转Unix时间戳
function date_to_unixtime($date, $timezone = 'PRC')
{
    $datetime = new DateTime($date, new DateTimeZone($timezone));
    return $datetime->format('U');
}

// echo date_to_unixtime("1900-1-1"); //输出-2206425952
$a = date_to_unixtime("1900-1-0") + 5677 * 24 * 60 * 60; //输出-2206425952
echo '<br>';
// echo unixtime_to_date(date_to_unixtime("1900-1-01")); //输出1900-01-31 00:00:00
echo unixtime_to_date($a); //输出1900-01-31 00:00:00
