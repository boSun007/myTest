<?php

try{
    throw new \Exception ("LLL");
}catch(\Exception $e){
    echo $e->getMessage();
}