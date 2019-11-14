<?Php

$a= '{
    "_id" : "5a3d4a7d94e7d58cd34d0823",
    "openid" : "",
    "session_key" : {
        "session_key" : "",
        "deadline" : ""
    },
    "unionid" : "",
    "username" : "Mandy",
    "avatar_url" : "",
    "token" : "mandytoken",
    "truename" : "",
    "school" : "",
    "school_account" : "",
    "school_password" : "",
    "major" : "",
    "dorm" : ""
}';
$str2='{"code":200,"datas":{"id":1,"coupon_id":"123","validity":"2018-08-14","is_use":0,"source":"2","create_time":"2018-08-14 15:06:40"}}';

$bom = chr(239).chr(187).chr(191); 
$c = str_replace($bom ,'',$a);    
$c = str_replace($bom ,'',$str2);    


$b= json_decode($a,true);
var_dump($b);