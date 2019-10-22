<?php
$host = "centriumres.com.localdomain.ee";
$host = "192.168.10.211";
$dbSettings = [
    "PWD" => "D3v", // see below for live
    "Database" => "Serenity",
    "UID" => "Dev", // see below for live
    "CharacterSet" => "UTF-8", // otherwise, characters in Property details truncates return from SQL driver
];


$conn =  sqlsrv_connect($host, $dbSettings);




/**************selsect *********************/
$rtn=array();
$sql = 'select * from XMLBookingLogin where XMLBookingLoginID >20';
$result = sqlsrv_query($conn,$sql);
while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
    $rtn[]=$row;
  }
  
// var_dump($rtn);


/**************selsect ADV*********************/
$rtn=array();
$sql = 'select * from XMLBookingLogin where XMLBookingLoginID >?';
$arr =[75];
$result = sqlsrv_query($conn,$sql,$arr);
while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
    $rtn[]=$row;
  }
  
// var_dump($rtn);



/**************selsect PARE STMT *********************/
$rtn=array();
$sql = 'select * from XMLBookingLogin where XMLBookingLoginID >?';
$arr =[75];
$result = sqlsrv_prepare($conn,$sql,$arr);
sqlsrv_execute($result);
while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
    $rtn[]=$row;
  }
  
var_dump($rtn);



/**************selsect PARE STMT *********************/
$rtn=array();
$sql = 'INSERT INTO TransactionBlc(Customer,Amount,Currency,Email,Address,City,Tel,Postcode,Country,PSPID,TransTime) VALUES (?,?,?,?,?,?,?,?,?,?,?);';

$arr = json_decode('["Mr test test","314065","GBP","test@ser.se","asdf","asdfds","01245785477","se123se","UK","epdq7169243","1571754306"]');

$resource=sqlsrv_query($conn, $sql, $arr); 
sqlsrv_next_result($resource); 
sqlsrv_fetch($resource); 
echo sqlsrv_get_field($resource, 0); 

// die();


die();


$resource = sqlsrv_prepare($conn,$sql,$arr);
sqlsrv_execute($resource);
// sqlsrv_next_result($resource); 
// sqlsrv_fetch($resource); 
// echo sqlsrv_get_field($resource, 0); 

// die();



// // var_dump($a);
// // die();

$sql = 'SELECT * FROM TransactionBlc;';
$stmt = sqlsrv_query($conn,$sql);
// $stmt= sqlsrv_query($conn,$sql);
$row = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC);
var_dump($row);

// var_dump($row['RateCodeEnabled']);
// var_dump($row['RateCodeEnabled']===1);

