<?php
    /**
     * Created by PhpStorm.
     * User: Administrator
     * Date: 2019/3/31 0031
     * Time: 15:04
     */

    class UnitScript {
        static function JoinExisting(Unit $unit, Unit $occupyingUnit){
            $comp;
            if(!is_null($comp = $occupyingUnit->getComposite())){
                $comp->addUnit;
            }else{
                $comp =  new Army();
                $comp->addUnit($unit);
                $comp->addUnit($occupyingUnit);
            }
            return $comp;
        }
    }