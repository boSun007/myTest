<?php

use Phpml\ModelManager;

include_once __DIR__.'/../../vendor/autoload.php';

$modelPath =__DIR__.'/model/xor';

$modelManager = new ModelManager();

$restoredClassifier = $modelManager->restoreFromFile($modelPath);


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
$restoredClassifier->train($samples,$target);

$modelManager->saveToFile($restoredClassifier,$modelPath);

echo $restoredClassifier->predict([2321, 1328]);
echo PHP_EOL;
echo $restoredClassifier->predict([70, 70]);
echo PHP_EOL;
echo $restoredClassifier->predict([1281, 1281]);
echo PHP_EOL;
echo $restoredClassifier->predict([3, 1]);
echo PHP_EOL;
