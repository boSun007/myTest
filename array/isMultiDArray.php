<?php

/**check if the arrar is Multidimensional Arrays */

$unknowArray =[
    ["Mr test test1","314065","GBP","test@ser.se","asdf","asdfds","01245785477","se123se","UK","epdq7169243","1571754306"],
    ["Mr test test2","314065","GBP","test@ser.se","asdf","asdfds","01245785477","se123se","UK","epdq7169243","1571754306"],
    ["Mr test test3","314065","GBP","test@ser.se","asdf","asdfds","01245785477","se123se","UK","epdq7169243","1571754306"],
  ];

  
$unknowArray = ["Mr test test1","314065","GBP","test@ser.se","asdf","asdfds","01245785477","se123se","UK","epdq7169243","1571754306"];
//   $unknowArray =["Mr test test3","314065","GBP","test@ser.se","asdf","asdfds","01245785477","se123se","UK","epdq7169243","1571754306"];


  if(count($unknowArray) == count($unknowArray,1)){
      echo 'One-Dimensional Array';

  }else{
      echo 'Multidimensional Arrays';
  }