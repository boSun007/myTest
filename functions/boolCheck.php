<?php
 
// $key='xyz';

if(!empty($key) && !in_array($key,['abc','xyz'])){
// if(empty($key) || !in_array($key,['abc','xyz'])){
// if(empty($key) || ($key!='abc' && $key !='xyz')){
    echo 'aaa';
}else{
    echo 'bbb';
}