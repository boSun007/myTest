<?php

 abstract class DomainClass{
     private $group;
     public function __construct(){
         echo "ABCDE";
         $this->group = static::getGroup();
     }
     public static function create(){
         echo "STST";
         return new static();
     }
     static function getGroup(){
         return "default";
     }
 }

 class User extends DomainClass{
   
 }

 class Document extends DomainClass{
     static function getGroup(){
         return "document";
     }
 }
 class Spreadsheet extends Document{
   
 }
 echo "<hr />";
 print_r(User::create());
 print_r(Spreadsheet::create());

 class abc{
     public function __construct(){
         echo "ABC";
     }
     public static function def(){
         echo "EFG";
     }
 }

 abc::def();



