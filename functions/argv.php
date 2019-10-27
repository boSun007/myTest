<?php

function abc($a='A',$b='B',$c='C',$d='D'){
print_r(func_num_args());
// echo @func_get_arg(1);

// var_dump($tmp);exit;

if((@strtolower(trim(func_get_arg(1)) =='auto' && func_num_args()>=2 )|| func_num_args()<2) ){

    $b = DBRW;
    // if( defined("DBRW") ){
    //     $b = DBRW;
    // }
}

echo $b;
    // echo $a.$b.$c;
}


define("DBRW",'auto');
abc('abc');

  