<?php
$photoDir = __DIR__.'\img/';;
$file = $photoDir.'test.jpg'; 
$photo = imagecreatefromjpeg($file);
imagejpeg($photo,$photoDir."test2.jpg");
$info = 'abcdefg';
file_put_contents($photoDir.'test2.jpg',sprintf('%sInfo%s', $info, pack('n', strlen($info))), FILE_APPEND); //按自定义格式附加在图片文件之后

$s = file_get_contents($photoDir.'test2.jpg');

$t = unpack('A4t/noffs', $s); //取回自定义信息的长度
$t = unpack('A4t/noffs', substr($s, -6)); //取回自定义信息的长度

$v = substr($s, -6 - $t['offs'], -6); //取回自定义信息
echo $v;//abcdef

var_dump(gd_info());

