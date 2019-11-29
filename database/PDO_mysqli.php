<?php
 $username = "Dev";
 $password = "D3v";
 $host = "xml.centriumres.com.localdomain.ee";
 $db = "EE-Reports";

 $connection = new PDO("mysql:dbname=$db;host=$host;charset=utf8", $username, $password);
$query = "insert into XML_Data(`XML_Data_PropertyID`) values(?)"; 

for($i=0;$i<10;$i++){

    $protyID = mt_rand(1000,9999);
    $stmt = $connection->prepare($query);
    $stmt->execute([$protyID]);
    
//    print_r( $stmt->errorInfo());
    echo $connection->lastInsertId();
    echo PHP_EOL;
}
