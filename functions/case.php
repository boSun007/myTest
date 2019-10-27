<?php

$a = 'ccc';
$b;
switch ($a) {
    case $a == 'cc' ? True : false:
        $b = 'YES';
        break;
    default:
        $b = 'NO';
}

echo $b;
$hostname = 'ip-172-30-0-176.ec2.internal';
// var_dump(preg_match('/[a-zA-Z0-9].ec2.internal/',$hostname)?true:false);
// exit;
// $ip='';

// $a = preg_match('/[a-zA-Z0-9].ec2.internal/', $hostname);
// var_dump($a);exit;


switch ($hostname) {
    case preg_match('/[a-zA-Z0-9].ec2.internal/', $hostname) ? true : false:
        $b = 'HHH';
        break;
    default:
        $b = "xxxxxx";
}


echo $b;
$b = 'ABC';
$c = true;
switch ($b) {



    case 'XX':
        echo 'ABC';
        break;

    default:
        echo 'WWW';
        break;
    case $c:
        echo 'VVVV';
        break;
    case $c == 3 ? true : false:
        echo 'PPPPPP';
        break;
}
