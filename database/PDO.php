<?php

$host = "centriumres.com.localdomain.ee";
$userName = "Dev";
$password = "D3v";
$database = "Serenity";


$pdo = new PDO("sqlsrv:Server=$host;Database=$database", $userName, $password);

/**PDO Select ****************************************************/
$rtn=array();
$sql = "select top 10 * from transactionBlc WHERE ID >10";

$result = $pdo->query($sql);
$rtn = $result->fetchAll();
// print_r($rtn);

/** PDO Select STMT **********************************************/
$rtn=array();
$sql = "select top 10 * from transactionBlc WHERE ID >?";
$stmt = $pdo->prepare($sql);

$id= [270];
$stmt->execute($id);
$rtn = $stmt->fetchAll();
print_r($rtn);
$id=[273];
$stmt->execute($id);
$rtn = $stmt->fetchAll();
print_r($rtn);







