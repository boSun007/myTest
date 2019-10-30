<?php
// $p='a19';
// $propertyIDs = array();
// $propertyIDs[] = $p;
$base = ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'];
$keysNeedToDelete = [];

for($i=0;$i<mt_rand(1,26);$i++){
    $keysNeedToDelete[] = array_pop($base);
}

$b=[];

myfunc(...$keysNeedToDelete);

function myfunc(){
$a= func_get_args();
print_r($a);
}





// exit;

  
$red = new redis();
$red->connect('127.0.0.1');
$red->select(14);

$red->set('a','A');
$red->set('b','B');
$red->set('c','C');
$red->set('d','D');
$red->set('e','E');
$red->set('f','F');
$red->set('g','G');
$red->set('h','H');
$red->set('i','I');
$red->set('j','J');
$red->set('k','K');
$red->set('l','L');
$red->set('m','M');
$red->set('n','N');
$red->set('o','O');
$red->set('p','P');
$red->set('q','Q');
$red->set('r','R');
$red->set('s','S');
$red->set('t','T');
$red->set('u','U');
$red->set('v','V');
$red->set('w','W');
$red->set('x','X');
$red->set('y','Y');
$red->set('z','Z');

// $a =  $red->del('a','b','c','d','e','f');
$red->del(...$keysNeedToDelete);

// call_user_func_array("myfunc",$keysNeedToDelete);

// function myfunc(){

// }


// print_r($a);


// function del ( $key1, $key2, ....$keyn){}

//     $arr = ['a','b','c','d'];

//     del(a, b, c,d );
