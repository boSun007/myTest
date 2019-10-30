<?php 
echo 'total number of args '.$argc."\n";

echo "args:\n";
foreach($argv as $index=>$arg){
    echo "{$index}: {$arg} \n";
}

//run command: php index.php 1 2 3 4 