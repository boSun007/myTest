<?php
session_start();
// unset($_SESSION);

// $_SESSION['abc']='abc';
unset($_SESSION);

$_SESSION['abc']='abc';
// $_GET
// $_POST
// 

unset($_POST);
var_dump($_SESSION);
