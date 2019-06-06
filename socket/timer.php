<?php
function gen1(){
    for($i=1;$i<=10;$i++){
        echo "GEN1: {$i} ".PHP_EOL;
        sleep(1);
        yield;
    }
}

function gen2(){
    for($i=1;$i<=10;$i++){
        echo "GEN2: {$i} ".PHP_EOL;
        sleep(2);
        yield;
    }
}

$task1 = gen1();
$task2 = gen2();

while(true){
    echo $task1->current();
    echo $task2->current();
    $task1->next();
    $task2->next();
    
}
