<?php

$curl = curl_init();
$arr=array(
    CURLOPT_URL => "https://pp.api.yalago.com/hotels/Inventory/GetCountries",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_HTTPHEADER => array(
      "Accept: */*",
      "Accept-Encoding: gzip, deflate",
      "Cache-Control: no-cache",
      "Connection: keep-alive",
      "Content-Length: 0",
      "Cookie: __cfduid=da3fa84622fb86efb1ba40bd830f1d6b01574864929",
      "Host: pp.api.yalago.com",
      "Postman-Token: 5ca644c2-b08a-4861-9e44-4b0d241827c7,6a3041b3-b58d-4937-ab21-8fe49b6e98db",
      "User-Agent: PostmanRuntime/7.20.1",
      "X-Api-Key: 680576fc-67ac-47b6-b00f-e6d2a74f0a37",
      "cache-control: no-cache"
    ),
);
curl_setopt_array($curl, $arr);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}