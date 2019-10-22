<?php
$host = "centriumres.com.localdomain.ee";
$dbSettings = [
    "PWD" => "D3v", // see below for live
    "Database" => "Serenity",
    "UID" => "Dev", // see below for live
    "CharacterSet" => "UTF-8", // otherwise, characters in Property details truncates return from SQL driver
];


$conn =  sqlsrv_connect($host, $dbSettings);
  $sql = "SELECT
				Trade.TradeID,
				TradeName,
				BookingEnabled,
				RateCodeEnabled,
				ShowNoInventory,
				MultiMealBasis,
				NewRegionMapping,
				PropertyRoomTypeEnabled,
                EliteOnly,
                RoomsOnRequest,
				XMLBookingLogin
			    FROM XMLBookingLogin
                LEFT JOIN [Trade] ON Trade.TradeID = XMLBookingLogin.TradeID where XMLBookingLoginID=43";







//  $sql = 'INSERT INTO TransactionBlc(Customer,Amount,Currency,Email,Address,City,Tel,Postcode,Country,PSPID,TransTime) VALUES (?,?,?,?,?,?,?,?,?,?,?);SELECT SCOPE_IDENTITY()';
 $sql = 'INSERT INTO TransactionBlc(Customer,Amount,Currency,Email,Address,City,Tel,Postcode,Country,PSPID,TransTime) VALUES (?,?,?,?,?,?,?,?,?,?,?);';
		
$arr = json_decode('["Mr test test","314065","GBP","test@ser.se","asdf","asdfds","01245785477","se123se","UK","epdq7169243","1571754306"]');
 
// $resource=sqlsrv_query($conn, $sql, $arr); 
// sqlsrv_next_result($resource); 
// sqlsrv_fetch($resource); 
// echo sqlsrv_get_field($resource, 0); 

// die();

 


$resource = sqlsrv_prepare($conn,$sql,$arr);
sqlsrv_execute($resource);
// sqlsrv_next_result($resource); 
// sqlsrv_fetch($resource); 
// echo sqlsrv_get_field($resource, 0); 

// die();



// // var_dump($a);
// // die();

$sql = 'SELECT SCOPE_IDENTITY() as [IDc];';
$stmt = sqlsrv_query($conn,$sql);
// $stmt= sqlsrv_query($conn,$sql);
$row = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC);
var_dump($row);

// var_dump($row['RateCodeEnabled']);
// var_dump($row['RateCodeEnabled']===1);

