<?php

namespace EEAPI\FM2A;

use EEAPI\database;

include __DIR__ . '/../../autoload.php';

class mealBasis
{
    private static $redis;
    private static $db;
    private static $configFolder = 'FM2A';

    public function __construct()
    {
        self::$redis = database::getRedis(self::$configFolder);
        self::$db = database::getDB(self::$configFolder);
    }

    public function cacheMealBasis()
    {
        new self();

        $remoteMealBasis = $this->getRemoteMealBasis();
        $mealBasis = $this->getMealBasis();

        $mappedMealBasis = $this->mapMealBasis($mealBasis,$remoteMealBasis);

        return $this->updateRedis($mappedMealBasis);

    }

    private function updateRedis(array $array){
        return self::$redis->hMSet('mealBasis',$array);
    }

    private function mapMealBasis($mealBasis,$remoteMealBasis){
        return [
            '1'=>'FI',
            '6'=>'BB',
        ];
    }

    private function getMealBasis(){
        $query = "SELECT * FROM [MealBasis] ORDER BY MealBasisID";
        $result = self::$db->query($query);
        $row = $result->fetchAll(SQLSRV_FETCH_ASSOC); 
        return $this->formatMealBasis($row);
    }

    private function formatMealBasis($mealBasis){
        $basis = array();
        foreach($mealBasis as $meal){
            $basis[$meal['MealBasisID']] = [$meal['MealBasisCode']=>$meal['MealBasis']];
        }
        return $basis;
    }


    private function getRemoteMealBasis()
    {
        $mealBasis = $this->curlMealBasis();
        return $this->formatRemoteMealBasis($mealBasis);

    }

    private function formatRemoteMealBasis($mealBasis){
        $basis = array();
        // var_dump($mealBasis);
        // die();
        // $mealBasis = \json_decode(\json_encode($mealBasis),true);

        foreach($mealBasis as $meal){
            $key = (array)$meal["CODE"];
            $val =(array)$meal["NAME"];

            $basis[$key[0]] = $val[0];
            // echo PHP_EOL;
        }

        return $basis;


    }

    private function curlMealBasis()
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://v3vir.xml.cullinan.systems/accom/shared/basislist.pl",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "<BASISLIST></BASISLIST>",
            CURLOPT_HTTPHEADER => array(
                "Accept: */*",
                "Accept-Encoding: gzip, deflate",
                "Cache-Control: no-cache",
                "Connection: keep-alive",
                "Content-Length: 23",
                "Content-Type: application/xml",
                "Host: v3vir.xml.cullinan.systems",
                "Postman-Token: 21d7ceab-826d-41db-b9fa-b765abf7b26b,3362da92-8229-4cf5-b495-edff05a40f48",
                "User-Agent: PostmanRuntime/7.19.0",
                "cache-control: no-cache"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
            return false;
        } else {
           return simplexml_load_string($response);
        }
    }

   
}



$a = new mealBasis();
$b = $a->cacheMealBasis();

print_r($b);
