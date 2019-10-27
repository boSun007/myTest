<?php
$fp = fsockopen("127.0.0.1",1935,$errno,$errstr,5);

if(!$fp){
    die("$errstr($errno)<br />");

}

$data = http_build_query(array("username"=>"lily","pass"=>'123456'));

$out = "POST /post.php HTTP/1.1\r\n";
$out .= "Host: localhost\r\n";
$out .= "Content-Length:".strlen($data)."\r\n";
$out .= "Content-Type:applicaton/x-www-form-urlencoded\r\n";
$out .="Connection:keep-alive\r\n\r\n";
$out .= $data."\r\n\r\n";

fwrite($fp,$out);
$ret ="";
while(!feof($fp)){
    $ret .=fgets($fp,1280);
}
fclose($fp);
echo $ret;


