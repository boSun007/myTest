<?php

$file =__DIR__.'/iniFile.ini';

$config = parse_ini_file($file,true);

print_r($config);
