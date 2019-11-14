<?php

use mongo\log_test\mongoClass;
use mongo\log_test\mysqlClass;
use MongoDB\Driver\BulkWrite;


include __DIR__.'/../../autoload.php';


set_error_handler(function($errno, $errstr, $errfile, $errline, array $errcontext) {
     if (0 === error_reporting()) {
     return false;
     }
     throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
    });


    
$logs = getLogsFromDatabase();

$rs = putLogsIntoMongo($logs);
var_dump($rs);


function putLogsIntoMongo($logs){
    $mongo = mongoClass::gi();
    $bulk = new BulkWrite();

    foreach($logs as $log){
        $log['_id']= $log['RequestID'];
        try{
            $log['RawQuery'] = simplexml_load_string(preg_replace('/&(?!#?[a-z0-9]+;)/', '&amp;',  $log['RawQuery']));
            // echo $log['RequestID'].PHP_EOL;
        }catch(Exception $e){
            echo ('Have Problem with parse the XML, RequestID: '.$log['RequestID'].' - '.$e->getMessage()).PHP_EOL;
        }
        unset($log['ResponseXML']);
        // $bulk->insert($log); //just insert without duplicate update
        $bulk->update(['_id'=>$log['RequestID']],$log,['upsert'=>true]);
        
    }

   return $mongo->executeBulkWrite('log.test',$bulk);

}


function getLogsFromDatabase(){
    //$query = 'SELECT * FROM `2019-46-LogXMLAPILive` ORDER BY RequestID';
    // $query = 'SELECT * FROM LogXMLAPI_Dev ORDER BY RequestID';
    $query = 'SELECT * FROM `LogXMLAPI` ORDER BY RequestID';
    $result = mysqlClass::gi()->query($query);
    // var_dump($result);
    return mysqli_fetch_all($result, MYSQLI_ASSOC); 
}
