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

$stmt= sqlsrv_query($conn,$sql);
$row = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC);
    

var_dump($row['RateCodeEnabled']);
var_dump($row['RateCodeEnabled']===1);

