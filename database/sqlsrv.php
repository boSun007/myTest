<?php
$host = "centriumres.com.localdomain.ee";

$dbSettings = [
  "PWD" => "D3v", // see below for live
  "Database" => "Serenity",
  "UID" => "Dev", // see below for live
  "CharacterSet" => "UTF-8", // otherwise, characters in Property details truncates return from SQL driver
];


$conn =  sqlsrv_connect($host, $dbSettings);




/**************selsect *********************/
$rtn = array();
$sql = 'select * from XMLBookingLogin where XMLBookingLoginID >20';
$result = sqlsrv_query($conn, $sql);
while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
  $rtn[] = $row;
}

// var_dump($rtn);


/**************selsect ADV*********************/
$rtn = array();
$sql = 'select * from XMLBookingLogin where XMLBookingLoginID >?';
$arr = [75];
$result = sqlsrv_query($conn, $sql, $arr);
while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
  $rtn[] = $row;
}

// var_dump($rtn);



/**************selsect PARE STMT *********************/
$rtn = array();
$sql = 'select * from XMLBookingLogin where XMLBookingLoginID >?';
$arr = [75];
$result = sqlsrv_prepare($conn, $sql, $arr);
sqlsrv_execute($result);
while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
  $rtn[] = $row;
}

// var_dump($rtn);



/**************INSRT PARE STMT *********************/
$rtn = false;
$sql = 'INSERT INTO TransactionBlc(Customer,Amount,Currency,Email,Address,City,Tel,Postcode,Country,PSPID,TransTime) VALUES (?,?,?,?,?,?,?,?,?,?,?);';

$arr = json_decode('["Mr test test","314065","GBP","test@ser.se","asdf","asdfds","01245785477","se123se","UK","epdq7169243","1571754306"]');

$resource = sqlsrv_query($conn, $sql, $arr);
if($resource!==false){
  $rtn = true;
}
// var_dump($rtn);

/**************INSRT PARE STMT With Last Insert ID *********************/
$rtn = array();
$sql = 'INSERT INTO TransactionBlc(Customer,Amount,Currency,Email,Address,City,Tel,Postcode,Country,PSPID,TransTime) VALUES (?,?,?,?,?,?,?,?,?,?,?);';
$sql .= 'SELECT SCOPE_IDENTITY() as [IDc];';

$arr = json_decode('["Mr test test","314065","GBP","test@ser.se","asdf","asdfds","01245785477","se123se","UK","epdq7169243","1571754306"]');

$resource = sqlsrv_query($conn, $sql, $arr);


sqlsrv_next_result($resource);
sqlsrv_fetch($resource);
$lastInsertID = sqlsrv_get_field($resource, 0);
// echo $lastInsertID;

// die();


/**************INSRT PARE STMT With Array  *********************/

$rtn = false;

