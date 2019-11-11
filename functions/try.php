<?php

try {
    myfun();
    $my = 'abc';


} catch (Exception $e) {

    echo $my.$e->getMessage();
}
