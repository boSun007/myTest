<?php
$var = "abc";
$arr = ['ele1'=>&$var];
$var = "ccd";
echo $arr['ele1'];
die();
