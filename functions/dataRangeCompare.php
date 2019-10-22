<?php




$daterange1 = array('2020-09-24', '2020-09-28'); 
$daterange2 = array('2020-09-20', '2020-09-30'); 

$range_min = new DateTime(min($daterange1)); 
$range_max = new DateTime(max($daterange1)); 

$start = new DateTime(min($daterange2)); 
$end = new DateTime(max($daterange2)); 
 
if(($start >= $range_min && $end <= $range_max) or ($end >= $range_min && $start <= $range_max)){
 echo "yes have contact";
}else{
    echo "no Contact";
}
exit;



if ($start >= $range_min && $end <= $range_max) { 
echo 'Overlapping!'; 
} 
else if($end >= $range_min && $start <= $range_max){ 
echo "partialy"; 
} 
else { 
echo 'free!'; 
} 

echo PHP_EOL;

$daterange1 = array('2012-04-20', '2012-04-28'); 
$daterange2 = array('2012-04-20', '2012-04-22'); 

$range_min = new DateTime(min($daterange1)); 
$range_max = new DateTime(max($daterange1)); 

$start = new DateTime(min($daterange2)); 
$end = new DateTime(max($daterange2)); 

if ($start >= $range_min && $end <= $range_max) { 
    echo 'no! overlapped'; 
} else { 
    echo 'not Connected'; 
} 
