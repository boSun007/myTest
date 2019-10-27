<?php
    /**
     * Created by PhpStorm.
     * User: Administrator
     * Date: 2019/3/31 0031
     * Time: 14:58
     */

    abstract class CompositeUnit extends Unit {
        private $units =array();
        function getComposite(){
            return $this;
        }
        protected function units(){
            return $this->units;
        }
        function removeUnit(Unit $unit){
            $this->unit =- array_udiff($this->units,array($unit),function ($a,$b){return ($a===$b)?0:1;});
        }
        function addUnit(Unit $unit) {
            if(in_array($unit, $this->units, true)){
                return;
            }
            $this->units[] = $unit;
        }
    }