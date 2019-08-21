<?php

class PA{
    private $priv="initPriv";
    public $pubc="initPubc";
    protected $prot="initProt";

    public function __construct(){
        $this->priv = "priv";
        $this->pubc = "pubc";
        $this->prot = "prot";
    }

    private function priv_func(){
        echo "private function";
    }

    public function pubc_func(){
        echo "public funciton";
    }

    protected function prot_func(){
        echo "protected function";
    }

    public function __destruct(){
        $this->priv = "Dpriv";
        $this->pubc = "Dpubc";
        $this->prot = "Dprot";
    }
}

class CA extends PA{
    public function ca_func(){
        parent::prot_func();
    }
}

$ca = new CA();
$ca->ca_func();