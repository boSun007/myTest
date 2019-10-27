<meta charset="utf-8" />
<?php

/**
 * * search current folder and its subfolder for anyfile named as pic type file
 * * but getimagesize fails
 */ 


error_reporting(0);

set_error_handler('myError');
function myError($type,$message,$file,$line){
    throw new \Exception($message . 'zyf错当做异常');
}

  

$path = './';


$result = scanFile($path);

var_dump($result['n']);

function scanFile($path) {
    global $result;
    $picExt = ['jpg', 'png', 'gif'];
    $errorFile = array();
    $parentFolder = "";
    $fullFolder="";

    $files = scandir($path);
    foreach ($files as $key=>$file) {
        if ($file != '.' && $file != '..') {
            if (is_dir($path . '/' . $file)) {
//                $result[]=$path."/".$file;
                scanFile($path . '/' . $file);
            } else {
                $fileExt = strtolower(substr($file, -3));

                if (in_array($fileExt, $picExt)) {
//                    echo $path . "/" . $file."<br />";

                       if(getimagesize($path . "/" . $file)){
							$result['y'][]=$path."/".$file;
						}else{
							$result['n'][]= $path . "/" . $file;
                       }
                       
                }
            }
        }
    }
    return $result;
}


//
//$path = "./";
//
//$result = ScanFile($path);
//var_dump($result);

function ScanFile1($folder) {

    $picExt = ['jpg', 'png', 'gif'];
    $errorFile = array();
    $parentFolder = "";
    $fullFolder="";
    $files = scandir($folder);

    foreach ($files as $key => $file) {
//        if ($file != "." && $file != ".." && $file != ".idea") {
        if ($file != "." && $file != "..") {
            if (is_dir($folder."/".$file)) {
//echo $folder . "/" . $file."/<br />";
                echo $folder."/".$file."<br />";
                ScanFile($folder . "/" . $file);
            } else {
//echo "BBBB".$file."--".$folder."<br />";
                $fileExt = strtolower(substr($file, -3));

                if (in_array($fileExt, $picExt)) {
//                    if (!is_string(getimagesize($folder . "/" . $file)[3])) {
//
//                        $errorFile[$key] = $parentFolder . "/" . $file;
//
//                    }
                }

            }
        }

    }
    return $errorFile;
}

