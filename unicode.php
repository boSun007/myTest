<?php
// $str = "a";
// $unicode = mb_detect_encoding($str); 
// echo $unicode; //ASCII

// $newStr = mb_convert_encoding($str,"UTF-8");

// echo mb_detect_encoding($newStr); //ASCII

$str = "a";
// iconv_set_encoding('internal_encoding','ASCII');

$result =  iconv_get_encoding('all');


var_dump($result);
