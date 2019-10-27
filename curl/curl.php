<?php
$targets = [
    'https://www.imooc.com/',
    'http://www.runoob.com'
];

$curl = array();
$ch = curl_multi_init();
foreach ($targets as $key => $target) {
    $curl[$key] = curl_init($target);
    curl_setopt($curl[$key], CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($curl[$key], CURLOPT_TIMEOUT, 35000);
    curl_setopt($curl[$key], CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl[$key], CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl[$key], CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl[$key], CURLOPT_POST, true);

    curl_multi_add_handle($ch, $curl[$key]);
}

do {
    curl_multi_exec($ch, $exec);
} while ($exec > 0);

$rtn = '';
foreach ($curl as $result) {
    $rtn .= "ABOA" . substr(curl_multi_getcontent($result), 0, 500) . PHP_EOL;
}

echo $rtn;
// var_dump($curl);
