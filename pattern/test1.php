<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/18 0018
 * Time: 12:39
 */
include_once "class/Person.php";
//$p = new Person();
//$p->Name="DOc";
//echo $p->getName();
//unset($p->_name);
//echo $p->name;
//if(isset($p->abc)){
//    echo $p->name;
//}

//$person =new Person(new PersonWriter());

//echo $person->writeName($person);

//$origin = new cloneTest("abc",45);
//$origin->setId(30);
//$test = $origin;
//$test->setId(45);
//echo $test->id;
//echo "FF".$origin->id;
//$clone = clone $origin;
//echo "cc".$clone->id;
//
//$person = new Person1("bob",44, new Account(200));
//$person->setId(343);
//$person2 = clone $person;
//$person->account->balance +=10;
//echo $person->account->balance;
//echo "<hr />";
//echo $person2->account->balance;

//    function myFunc($arg){
//        var_dump($arg);
//    }
//
//$product = new Product("phone",300);
//$processSales = new ProcessSale();
//$processSales->registerCallback("myFu2nc");
//echo $processSales->sale($product);

$a = new cloneTest("bo",35);
$b = $a->tt;
var_dump($b);
print_r($b);




