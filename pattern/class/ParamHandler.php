<?php
    /**
     * Created by PhpStorm.
     * User: Administrator
     * Date: 2019/2/21 0021
     * Time: 13:54
     */

    class ParamHandler {
    protected $source;
    protected $params =array();

    function __construct($source) {
        $this->source = $source;
    }

    function addParam($key,$val){
        $this->params[$key] = $val;
    }

    function getAllParams(){
        return $this->params;
    }

    static function getInstance($filename){
        if(preg_match("/\.xml$/i",$filename)){
            return new XmlParamHandler($filename);
        }
        return new TextParamHandler($filename);
    }

    abstract function write();
    abstract function read();

    }