<?php

namespace EEAPI\YALAGO;

use EEAPI\database;

set_time_limit(0);

class getEstablishments
{
    private $curl;


    public function getEstablishmentsList()
    {
      
        $redis = database::getRedis('YALAGO');
        $res = $redis->lrange('Establishment',0,-1);
        $arr= array();
        foreach($res as $re){
            $arr[]=$re;
        }
        $count = $redis->get('count');
        // die();
        var_dump(count($arr) == $count);
        die();
      
        // $this->test(10673, 207231, 1147431);
        // die();
        $countries = $this->getCountries();
        $province = $this->getProvinces($countries);
        $location = $this->getLocations($province);
        $establishments = $this->getEstablishment($location);
    }

//     private function test($countryCode, $proviceCode, $location)
//     {
//         $establishments = array();
//         $redis = database::getRedis('YALAGO');
//         $curlOptions = array(
//             CURLOPT_URL => "https://pp.api.yalago.com/hotels/Inventory/GetEstablishments",
//             CURLOPT_RETURNTRANSFER => true,
//             CURLOPT_ENCODING => "",
//             CURLOPT_MAXREDIRS => 10,
//             CURLOPT_TIMEOUT => 30,
//             CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//             CURLOPT_CUSTOMREQUEST => "POST",
//             CURLOPT_POSTFIELDS => "{\r\nCountryId: {$countryCode},\r\nProvinceId: {$proviceCode},\r\nLocationId: {$location},\r\nLanguages: [\"en\"]\r\n}\r\n",
//             CURLOPT_HTTPHEADER => array(
//                 "Accept: */*",
//                 "Accept-Encoding: gzip, deflate",
//                 "Cache-Control: no-cache",
//                 "Connection: keep-alive",
//                 "Content-Length: 87",
//                 "Content-Type: application/json",
//                 "Cookie: __cfduid=da3fa84622fb86efb1ba40bd830f1d6b01574864929",
//                 "Host: pp.api.yalago.com",
//                 "Postman-Token: 179dab79-60d2-4c5d-80ed-7ddc445bb726,8b1408c9-0f40-40e8-8719-31117980ddfc",
//                 "User-Agent: PostmanRuntime/7.20.1",
//                 "X-Api-Key: 680576fc-67ac-47b6-b00f-e6d2a74f0a37",
//                 "cache-control: no-cache"
//               ),
//         );
  
    
 
//         $res = $this->curl($curlOptions);
//         if ($res['status']) {
// var_dump(json_decode($res['data'], true));
// // die();
//             foreach (json_decode($res['data'], true)['Establishments'] as $establishment) {
//                 $establishment['Description'] = $establishment['Description']['en'];
//                 $establishment['Summary'] = $establishment['Summary']['en'];
//                 $establishment['Images'] = json_encode($establishment['Images']);
//                 $establishment['RoomTypes'] = json_encode($establishment['RoomTypes']);
//                 $facility = array();
//                 if($establishment['Facilities']){
//                     foreach ($establishment['Facilities'] as $facilityArr) {
//                         $facility[$establishment['EstablishmentId']][$facilityArr['FacilityId']] = $facilityArr['Description'];
//                     }
                    
//                     $redis->hMset('Facility_' . $establishment['EstablishmentId'], $facility[$establishment['EstablishmentId']]);
//                 }
//                 unset($establishment['Facilities']);
//                 $establishments[$establishment['EstablishmentId']] = $establishment;
//                 $redis->hMset($establishment['EstablishmentId'], $establishments[$establishment['EstablishmentId']]);
//             }
//         }
//     }



    private function getEstablishment(array $location)
    {
        $establishments = array();
        $redis = database::getRedis('YALAGO');
        $redis->set("count",0);
        foreach ($location as $countryCode => $provices) {
            foreach ($provices as $proviceCode => $loctions) {
                foreach ($loctions as $location) {

                    echo $countryCode . '-----' . $proviceCode . '-----' . $location . PHP_EOL;
                    $option = ['CountryId' => $countryCode, 'ProvinceId' => $proviceCode, 'LocationId' => $location, 'Language' => "en"];


                    $curlOptions = array(
                        CURLOPT_URL => "https://pp.api.yalago.com/hotels/Inventory/GetEstablishments",
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 30,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => "POST",
                        CURLOPT_POSTFIELDS => "{\r\nCountryId: {$countryCode},\r\nProvinceId: {$proviceCode},\r\nLocationId: {$location},\r\nLanguages: [\"en\"]\r\n}\r\n",
                        CURLOPT_HTTPHEADER => array(
                            "Accept: */*",
                            "Accept-Encoding: gzip, deflate",
                            "Cache-Control: no-cache",
                            "Connection: keep-alive",
                            "Content-Length: 74",
                            "Content-Type: application/json",
                            "Cookie: __cfduid=da3fa84622fb86efb1ba40bd830f1d6b01574864929",
                            "Host: pp.api.yalago.com",
                            "Postman-Token: fa8cf33c-ded3-429e-8638-25b3e5afd23f,d7d9f18d-edfd-490d-be60-bf57634cdf96",
                            "User-Agent: PostmanRuntime/7.20.1",
                            "X-Api-Key: 680576fc-67ac-47b6-b00f-e6d2a74f0a37",
                            "cache-control: no-cache"
                        ),
                    );

                    $res = $this->curl($curlOptions);
                    if ($res['status']) {

                        foreach (json_decode($res['data'], true)['Establishments'] as $establishment) {
                            $establishment['Description'] = $establishment['Description']['en'];
                            $establishment['Summary'] = $establishment['Summary']['en'];
                            $establishment['Images'] = json_encode($establishment['Images']);
                            $establishment['RoomTypes'] = json_encode($establishment['RoomTypes']);
                            $establishment['CountryCode'] = $countryCode;
                            $establishment['ProviceCode'] = $proviceCode;
                            $facility = array();
                            if($establishment['Facilities']){
                                foreach ($establishment['Facilities'] as $facilityArr) {
                                    $facility[$establishment['EstablishmentId']][$facilityArr['FacilityId']] = $facilityArr['Description'];
                                }
                                
                                $redis->hMset('Facility_' . $establishment['EstablishmentId'], $facility[$establishment['EstablishmentId']]);
                            }
                            unset($establishment['Facilities']);
                            $establishments[$establishment['EstablishmentId']] = $establishment;
                            $redis->lPush('Establishment',$establishment['EstablishmentId']);
                            $redis->hMset($establishment['EstablishmentId'], $establishments[$establishment['EstablishmentId']]);
                            $redis->incr('count');
                            
                        }
                    }
                }
            }
        }
    }

    private function getLocations($provinces)
    {
        $location = array();
        foreach ($provinces as $countryCode => $province) {
            $res = $this->getLocation($countryCode, $province);
            $location[$countryCode] = $res;
        }
        return $location;
    }

    private function getLocation(int $countryCode, array $provinces)
    {
        $location = array();
        foreach ($provinces as $province) {
            $curlOptions = array(
                CURLOPT_URL => "https://pp.api.yalago.com/hotels/Inventory/GetLocations",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => "{\r\n\"CountryId\": {$countryCode},\r\n\"ProvinceId\": {$province}\r\n}\r\n",
                CURLOPT_HTTPHEADER => array(
                    "Accept: */*",
                    "Accept-Encoding: gzip, deflate",
                    "Cache-Control: no-cache",
                    "Connection: keep-alive",
                    "Content-Length: 47",
                    "Content-Type: application/json",
                    "Cookie: __cfduid=da3fa84622fb86efb1ba40bd830f1d6b01574864929",
                    "Host: pp.api.yalago.com",
                    "Postman-Token: ebb7a881-ed9c-455e-987a-695d04f0732a,cfd45012-bb52-4818-82c9-8f1f6b3de40e",
                    "User-Agent: PostmanRuntime/7.20.1",
                    "X-Api-Key: 680576fc-67ac-47b6-b00f-e6d2a74f0a37",
                    "cache-control: no-cache"
                ),
            );

            $res = $this->curl($curlOptions);

            if ($res['status']) {
                $locationArray = json_decode($res['data'], true);
                foreach ($locationArray['Locations'] as $local) {
                    $location[$province][] = $local['LocationId'];
                }
            }
        }
        return $location;
    }

    private function getCountries()
    {
        $curlOptions = array(
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
        $result = $this->curl($curlOptions);
        if ($result['status']) {
            $countries = json_decode($result['data'], true);
        } else {
            $countries = false;
        }

        return $countries['Countries'];
    }

    private function getProvinces(array $countries)
    {
        $result = array();
        foreach ($countries as $country) {
            $countryID = $country['CountryId'];
            $countryCode = $country['CountryCode'];
            $countryTitle = $country['Title'];
            $res = $this->curlProvince($countryID);
            if ($res['status']) {
                $provinces = json_decode($res['data'], true);
                foreach ($provinces['Provinces'] as $province) {
                    $result[$countryID][] = $province['ProvinceId'];
                }
            }
        }
        // print_r($provinces);
        return $result;
    }

    private function curlProvince(int $countryID)
    {
        $curlOptions = array(
            CURLOPT_URL => "https://pp.api.yalago.com/hotels/Inventory/GetProvinces",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\r\n\"CountryId\": {$countryID}\r\n}\r\n",
            CURLOPT_HTTPHEADER => array(
                "Accept: */*",
                "Accept-Encoding: gzip, deflate",
                "Cache-Control: no-cache",
                "Connection: keep-alive",
                "Content-Length: 25",
                "Content-Type: application/json",
                "Cookie: __cfduid=da3fa84622fb86efb1ba40bd830f1d6b01574864929",
                "Host: pp.api.yalago.com",
                "Postman-Token: eb9b474e-be85-442b-be70-7e02761c13f3,12d1cc49-5cd9-4c57-af8b-ed39c1a88cf6",
                "User-Agent: PostmanRuntime/7.20.1",
                "X-Api-Key: 680576fc-67ac-47b6-b00f-e6d2a74f0a37",
                "cache-control: no-cache"
            ),
        );
        $res = $this->curl($curlOptions);
        return $res;
    }

    private function curl($curlOptions)
    {

        $rtn = array();
        $curl = curl_init();
        curl_setopt_array($curl, $curlOptions);
        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            $rtn['status'] = false;
            echo  $rtn['data'] = "cURL Error #:" . $err;
        } else {
            $rtn['status'] = true;
            $rtn['data'] = $response;
        }
        $this->curl = $curl;

        return $rtn;
    }
}
