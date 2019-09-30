<?php
$host = "centriumres.com.localdomain.ee";
$dbSettings = [
    "PWD" => "D3v", // see below for live
    "Database" => "Serenity",
    "UID" => "Dev", // see below for live
    "CharacterSet" => "UTF-8", // otherwise, characters in Property details truncates return from SQL driver
];


$userName = "Dev";
$password = "D3v";
$database = "Serenity";


// $pdo = new PDO("sqlsrv:Server=$host;Database=$database", $userName, $password);
// return $pdo;

  $conn = sqlsrv_connect($host, $dbSettings);

  $sql = "select * from XMLBookingLogin WHERE Login ='sdfasfasdfsa'";
$rtn=array();
$stmt = sqlsrv_prepare()
  $stmt = sqlsrv_query($conn, $sql);
  while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $rtn[]=$row;
  }
  
  var_dump($rtn);