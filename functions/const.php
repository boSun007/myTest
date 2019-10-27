<?php

function con(){
    echo "ABC";
    static $a = 0;
   
    $a++;
    echo $a;
    echo "EDF";
    static $a=200;
    echo $a;
    // $a++;
    // echo $a;
   echo "<hr />";
}

echo con();
echo con();
echo con();
echo con();

?>

