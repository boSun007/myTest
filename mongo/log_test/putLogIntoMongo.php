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
// var_dump($rs);


function putLogsIntoMongo($logs){
    $mongo = mongoClass::gi();
    $bulk = new BulkWrite();
    // var_dump($logs[26]);
    // die();

    $document = new DOMDocument();

    foreach($logs as $log){
        $log['_id']= $log['RequestID'];
        try{

            $document->loadXML($log['RawQuery']);
            // var_dump($document);die();

            $log['RawQuery'] = simplexml_load_string(preg_replace('/&(?!#?[a-z0-9]+;)/', '&amp;',  $log['RawQuery']));
            // echo $log['RequestID'].PHP_EOL;
        }catch(Exception $e){
            echo ('Have Problem with parse the XML, RequestID: '.$log['RequestID'].' - '.$e->getMessage()).PHP_EOL;
        }
        unset($log['ResponseXML']);

    // die(var_dump( $log['RawQuery']));
    // die(var_dump( $log));
        // $bulk->insert($log); //just insert without duplicate update
        $bulk->update(['_id'=>$log['RequestID']],$log,['upsert'=>true]);
        
    }

   return $mongo->executeBulkWrite(mongoClass::$database.'.'.mongoClass::$collections,$bulk);

}


function getLogsFromDatabase(){
    // $query = 'SELECT * FROM `2019-46-LogXMLAPILive` ORDER BY RequestID';
    // $query = 'SELECT * FROM LogXMLAPI_Dev ORDER BY RequestID';
    $query = 'SELECT * FROM `LogXMLAPI` ORDER BY RequestID';
    $result = mysqlClass::gi()->query($query);
    // var_dump($result);
    return mysqli_fetch_all($result, MYSQLI_ASSOC); 
}
