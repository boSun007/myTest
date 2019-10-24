<?php
$host = "centriumres.com.localdomain.ee";

$dbSettings = [
  "PWD" => "D3v", // see below for live
  "Database" => "Serenity",
  "UID" => "Dev", // see below for live
  "CharacterSet" => "UTF-8", // otherwise, characters in Property details truncates return from SQL driver
];


$conn =  sqlsrv_connect($host, $dbSettings) or die(print_r(sqlsrv_errors()));




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



/**************INSRT PARE  *********************/
$rtn = false;
$sql = 'INSERT INTO TransactionBlc(Customer,Amount,Currency,Email,Address,City,Tel,Postcode,Country,PSPID,TransTime) VALUES (?,?,?,?,?,?,?,?,?,?,?);';

$arr = json_decode('["Mr test test","314065","GBP","test@ser.se","asdf","asdfds","01245785477","se123se","UK","epdq7169243","1571754306"]');

$resource = sqlsrv_query($conn, $sql, $arr);
if ($resource !== false) {
  $rtn = true;
}
// var_dump($rtn);

/**************INSRT PARE  With Last Insert ID *********************/
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


/**************INSRT PARE With Array  *********************/

$rtn = false;

$sql = 'INSERT INTO TransactionBlc(Customer,Amount,Currency,Email,Address,City,Tel,Postcode,Country,PSPID,TransTime) VALUES (?,?,?,?,?,?,?,?,?,?,?);';

$values = [
  ["Mr test test1", "314065", "GBP", "test@ser.se", "asdf", "asdfds", "01245785477", "se123se", "UK", "epdq7169243", "1571754306"],
  ["Mr test test2", "314065", "GBP", "test@ser.se", "asdf", "asdfds", "01245785477", "se123se", "UK", "epdq7169243", "1571754306"],
  ["Mr test test3", "314065", "GBP", "test@ser.se", "asdf", "asdfds", "01245785477", "se123se", "UK", "epdq7169243", "1571754306"],
];

if (count($values) == count($values, 1)) {
  $stmt = sqlsrv_query($conn, $sql, $values);
} else {
  foreach ($values as $value) {
    $stmt = sqlsrv_query($conn, $sql, $value);
  }
}

/** INSERT MULT Pare WITH STMT  */
$rtn = false;


$values = [
  'TransactionBlc' =>
  [
    [
      'customer' => "Mr test test4",
      'amount' => "314065",
      'currency' => "GBP",
      'email' => "test@ser.se",
      'address' => "asdf",
      'city' => "asdfds",
      'tel' => "01245785477",
      'postcode' => "se123se",
      'country' => "UK",
      'pspid' => "epdq7169243",
      'transtime' => "1571754306"
    ],
    [
      'customer' => "Mr test test5",
      'amount' => "314065",
      'currency' => "GBP",
      'email' => "test@ser.se",
      'address' => "asdf",
      'city' => "asdfds",
      'tel' => "01245785477",
      'postcode' => "se123se",
      'country' => "UK",
      'pspid' => "epdq7169243",
      'transtime' => "1571754306"
    ],
    [
      'customer' => "Mr test test6",
      'amount' => "314065",
      'currency' => "GBP",
      'email' => "test@ser.se",
      'address' => "asdf",
      'city' => "asdfds",
      'tel' => "01245785477",
      'postcode' => "se123se",
      'country' => "UK",
      'pspid' => "epdq7169243",
      'transtime' => "1571754306"
    ],
  ]
];

insertMultArray($values, $conn);


function insertMultArray($array, $conn)
{
  $table = array_keys($array)[0];
  $cols = $vals = '';
  // echo $cols = implode(',' array_keys($array[$table]));
  foreach ($array[$table] as $record) {
    $cols = implode(',', array_keys($record));
    $vals = "'" . implode("','", array_values($record)) . "'";
    $val = array();
    for ($i = 0; $i < count($record); $i++) {
      $val[] = '?';
    }

    $sql  = "INSERT INTO $table ($cols) VALUES($vals);";

    $stmt = sqlsrv_prepare($conn, $sql, array_values($record));
    sqlsrv_execute($stmt) or die(print_r(sqlsrv_errors()));
  }
}
