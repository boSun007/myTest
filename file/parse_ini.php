<?php
define('BIRD','Dodo bird');
set_include_path(__DIR__);

echo get_include_path();


$ini_array = parse_ini_file( 'config.ini');
 print_r($ini_array);