<?php
namespace exceptionError\multiCatch;

use Exception;

abstract class myHandler extends Exception{

    abstract public function process();
}