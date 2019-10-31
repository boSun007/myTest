<?php

$arr = ['a'=>'A','b'=>'B'];

unset($arr['a']);
unset($arr['b']);

if(isset($arr)){
    echo 'll';
}else{
    echo 'XX';
}

$inputErrataData=['Errata'=>'nice'];

$errataData = [
    'PropertyID' => array_key_exists('PropertyID', $inputErrataData) ? $inputErrataData['PropertyID'] : false,
    'ErrataStart' => array_key_exists('ErrataStart', $inputErrataData) ? $inputErrataData['ErrataStart'] : false,
    'ErrataEnd' => array_key_exists('ErrataEnd', $inputErrataData) ? $inputErrataData['ErrataEnd'] : false,
    'Errata' => array_key_exists('Errata', $inputErrataData) ? $inputErrataData['Errata'] : false,
    'ErrataPK' => array_key_exists('ErrataPK', $inputErrataData) ? $inputErrataData['ErrataPK'] : false,
];
// print_r($errataData);

if (in_array(false, $errataData, true)) {
 echo 'FFF';
}else{
    echo 'xxxx';
}