<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "http://v3vir.xml.cullinan.systems/accom/test/availallsearch.pl",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "<AVAILALLSEARCH>\r\n  <AGENT>VIR</AGENT>\r\n  <CHECKINDATE>20200808</CHECKINDATE>\r\n  <CHECKOUTDATE>20200815</CHECKOUTDATE>\r\n  <REGIONS> \r\n      <REGION>CPT</REGION>                      \r\n\r\n  </REGIONS> \r\n  <SUBREGION>Camps Bay</SUBREGION>\r\n  <PROPCODE>bayh01</PROPCODE>\r\n  <PROPNAME>Bay Hotel</PROPNAME>\r\n  <STARRATING>4</STARRATING>\r\n\r\n  <SEARCHES>\r\n      <SEARCH>\r\n          <SEARCHID>1</SEARCHID>\r\n          <ROOMQTY>1</ROOMQTY>\r\n          <ADULTS>2</ADULTS>\r\n      </SEARCH>\r\n      <SEARCH>\r\n          <SEARCHID>2</SEARCHID>\r\n          <ROOMQTY>1</ROOMQTY>\r\n          <ADULTS>2</ADULTS>\r\n          <CHILDS>\r\n              <CHILDAGE>14</CHILDAGE>\r\n          </CHILDS>\r\n      </SEARCH>\r\n  </SEARCHES>\r\n  <STYLED>N</STYLED>\r\n</AVAILALLSEARCH>",
  CURLOPT_HTTPHEADER => array(
    "Accept: */*",
    "Accept-Encoding: gzip, deflate",
    "Cache-Control: no-cache",
    "Connection: keep-alive",
    "Content-Length: 740",
    "Content-Type: application/xml",
    "Host: v3vir.xml.cullinan.systems",
    "Postman-Token: f0a524ed-d77e-4b7a-8ced-53f7ef3ebf3c,638f0e7e-50db-4d0c-a232-44e79aa45942",
    "User-Agent: PostmanRuntime/7.17.1",
    "cache-control: no-cache"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  $response = simplexml_load_string($response);
}

print_r($response);