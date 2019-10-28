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

 

/** insert with last insert id **NOT SCOP_IDENTITY */

$sql = 'INSERT INTO TransactionBlc(Customer,Amount,Currency,Email,Address,City,Tel,Postcode,Country,PSPID,TransTime) VALUES (?,?,?,?,?,?,?,?,?,?,?);';
$arr = json_decode('["Mr test test","314065","GBP","test@ser.se","asdf","asdfds","01245785477","se123se","UK","epdq7169243","1571754306"]');
$stmt = $pdo->prepare($sql);
$result = $stmt->execute($arr);
echo $pdo->lastInsertId().PHP_EOL;


/** insert with last insert id **NOT SCOP_IDENTITY */
/**instead of INSERTED also available in UPDATED / DELETED */
$sql = "INSERT INTO TransactionBlc (Customer,Amount,Currency,Email,Address,City,Tel,Postcode,Country,PSPID,TransTime) OUTPUT INSERTED.ID as myLastInsrtedID VALUES (?,?,?,?,?,?,?,?,?,?,?);";
$arr = json_decode('["Mr test test97","314065","GBP","test@ser.se","asdf","asdfds","01245785477","se123se","UK","epdq7169243","1571754306"]');
$sth = $pdo->prepare($sql);

$sth->execute($arr);

$result = $sth->fetch(PDO::FETCH_ASSOC);

echo $lastInsertID = $result['myLastInsrtedID'];
print_r($result);

echo '-------------------------------'.PHP_EOL;




/** simple version */
$sql = "INSERT INTO TransactionBlc (Customer,Amount,Currency,Email,Address,City,Tel,Postcode,Country,PSPID,TransTime) OUTPUT INSERTED.ID as myLastInsrtedID VALUES ('Mr test test97','314065','GBP','te23st@ser.se','asdf','asdfds','01245785477','se123se','UK','epdq7169243','1571754306');";
$result = $pdo->query($sql);
foreach($result as $key => $row){
    print_r($row);
}

/** simple version */
$sql = "INSERT INTO TransactionBlc (Customer,Amount,Currency,Email,Address,City,Tel,Postcode,Country,PSPID,TransTime) OUTPUT INSERTED.ID as myLastInsrtedID VALUES ('Mr test test97','314065','GBP','te23st@ser.se','asdf','asdfds','01245785477','se123se','UK','epdq7169243','1571754306');";
$result = $pdo->query($sql,PDO::FETCH_NUM);

foreach($result as $row){
    print_r($row[0]);
}


