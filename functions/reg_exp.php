<?php

$str = "Is is the cost of of gasoline going up up";

$patten = " /\b([a-z]+) \1\b/i";

 preg_match($patten,$str,$matches);
 
 var_dump($matches);



 