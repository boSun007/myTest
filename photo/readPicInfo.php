<?php
$photoDir = __DIR__.'\img/';;
$file = $photoDir.'test.jpg'; 
$a = @exif_read_data($file,'IFD0',true,true);


print_r($a);
