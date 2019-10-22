<?php

$a = array(1,2,3);
$b = array(3,5,5);
$c = 'ABC';

// var_dump(md5($a.$b.$c)==md5($b.$a.$c));

echo json_encode([$a,$b]);
echo json_encode($a);