<?php
$str = 'DEV_772b9d1ae9526fc5db164425279bc3d8_TradeID_1203_XMLBookingLogin';

$mystring = 'DEV_772b9d1ae9526fc5db164425279bc3d8_TradeID_1203_XMLBookingLogin';
$findme   = 'DEV_';
$pos = strpos($mystring, $findme);

// Note our use of ===.  Simply == would not work as expected
// because the position of 'a' was the 0th (first) character.
if ($pos === false) {
    echo "The string '$findme' was not found in the string '$mystring'";
} else {
    echo "The string '$findme' was found in the string '$mystring'";
    echo " and exists at position $pos";
}