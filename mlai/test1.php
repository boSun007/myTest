<?php
include_once __DIR__.'/../vendor/autoload.php';

use Phpml\Classification\KNearestNeighbors;
use Phpml\Regression\LeastSquares;

$samples = [[12],[14],[17],[19],[22],[28]];
$target = [3.1,3.2,3.5,3.7,4.1,5];

$regression = new LeastSquares();

$regression->train($samples,$target);

$res = $regression->predict([3]);
echo $res;
echo PHP_EOL;
// $samples = [[1, 3], [1, 4], [2, 4], [3, 1], [4, 1], [4, 2]];
// $target = ['a', 'a', 'a', 'b', 'b', 'b'];
 
$samples =[
    [0,0],
    [1,1],
    [0,1],
    [1,0],
];

$target =[1,1,0,0];

$samples = array();
$target = array();
for($i=0;$i<100;$i++){
    $a = mt_rand(1,10);
    $b = mt_rand(1,10);
    if($a==$b){
        $c=1;
    }else{
        $c=0;
    }

    $samples[]=[$a,$b];
    $target[]=$c;
}

// print_r($samples);
// echo PHP_EOL;
// print_r($target);
 

$samples = [[1, 3], [1, 4], [2, 4], [3, 1], [4, 1], [4, 2]];
$labels = ['a', 'a', 'a', 'b', 'b', 'b'];

$classifier = new KNearestNeighbors();
$classifier->train($samples, $labels);

$filepath = '/path/to/store/the/model';
$modelManager = new ModelManager();
$modelManager->saveToFile($classifier, $filepath);

$restoredClassifier = $modelManager->restoreFromFile($filepath);
$restoredClassifier->predict([3, 2]);
// return 'b'

$classifier = new KNearestNeighbors();
$classifier->train($samples, $target);

echo $classifier->predict([99,99]);

echo PHP_EOL;
$samples = [[73676, 1996], [77006, 1998], [10565, 2000], [146088, 1995], [15000, 2001], [65940, 2000], [9300, 2000], [93739, 1996], [153260, 1994], [17764, 2002], [57000, 1998], [15000, 2000]];
$targets = [2000, 2750, 15500, 960, 4400, 8800, 7100, 2550, 1025, 5900, 4600, 4400];
$regression = new LeastSquares();
$regression->train($samples, $targets);
echo $regression->predict([60000, 1996]);