<?php
namespace exceptionError\exceptionHandler;

use Exception;

abstract class myHandler extends Exception{

    abstract public function process();
}