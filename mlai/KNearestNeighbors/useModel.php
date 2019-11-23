<?php

use Phpml\ModelManager;

include_once __DIR__.'/../../vendor/autoload.php';

$modelPath =__DIR__.'/model/xor';

$modelManager = new ModelManager();

$restoredClassifier = $modelManager->restoreFromFile($modelPath);
echo $restoredClassifier->predict([2, 8]);
echo PHP_EOL;
echo $restoredClassifier->predict([70, 70]);
echo PHP_EOL;
echo $restoredClassifier->predict([1281, 1281]);
echo PHP_EOL;
echo $restoredClassifier->predict([3, 1]);
echo PHP_EOL;