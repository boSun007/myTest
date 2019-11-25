<?php

use Phpml\Classification\KNearestNeighbors;
use Phpml\ModelManager;

include_once __DIR__.'/../../vendor/autoload.php';

$modelPath =__DIR__.'/model/xor';


$samples = array();
$target = array();
for($i=0;$i<10000000;$i++){
    $a = mt_rand(1,1000);
    $b = mt_rand(1,1000);
    if($a==$b){
        $c=1;
    }else{
        $c=0;
    }

    $samples[]=[$a,$b];
    $target[]=$c;
}



$classifier = new KNearestNeighbors();
$classifier->train($samples, $target);


$modelManager = new ModelManager();
$modelManager->saveToFile($classifier, $modelPath);



$restoredClassifier = $modelManager->restoreFromFile($modelPath);
echo $restoredClassifier->predict([3, 3]);
echo PHP_EOL;
echo $restoredClassifier->predict([128, 128]);
