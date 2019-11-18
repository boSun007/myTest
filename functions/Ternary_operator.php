<?php

$a=0;
$b=2;
$c=3;

   $otherCondition =[
0!=$a?['logos.int_cls','=',$a]:null,
0!=$b?['logos.name_type','=',$b]:null,
0!=$c?['logos.logo_length','=',$c]:null,
        ];

      // var_dump($otherCondition);
      
      $a=false;
      $b=true;

      $res = $a?'Y':$b?'a':'b';

      var_dump($res);
