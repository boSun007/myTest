<?php

$arr = ['a'=>'A','b'=>'B'];

unset($arr['a']);
unset($arr['b']);

if(isset($arr)){
    echo 'll';
}else{
    echo 'XX';
}
