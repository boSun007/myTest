<?php
    /**
     * Created by PhpStorm.
     * User: Administrator
     * Date: 2019/3/31 0031
     * Time: 14:04
     */



    class Army extends CompositeUnit{
        private $units = array();
        public $strength=0;
        function addUnit(Unit $unit) {
            $this->strength += $unit->bombardStrength();
            parent::$Tstrength += $unit->bombardStrength();
            if(in_array($unit,$this->units,true)){
                return;
            }
            $this->units[] = $unit;
        }
        public function removeUnit(Unit $unit) {
            $this->strength -= $unit->bombardStrength();
            $this->units = array_udiff($this->units,array($unit),function($a,$b){
                return ($a===$b)?0:1;
            });
        }
        public function bombardStrength() {
            $ret =0;
            foreach($this->units as $unit){
                $ret += $unit->bombardStrength();
            }
            return $ret;
        }
    }