<?php
    /**
     * Created by PhpStorm.
     * User: Administrator
     * Date: 2019/3/31 0031
     * Time: 14:31
     */

    function loadFile($class){
        echo $class.PHP_EOL;
        include $class.".php";

    }

    spl_autoload_register("loadFile");

    $army1 = new Army();
    $archer = new Archer();
    $laserCannon = new LaserCannonUnit();

    $unitt = UnitScript::JoinExisting($archer,$laserCannon);
  echo  $unitt->bombardStrength().PHP_EOL;
  echo  $unitt::$Tstrength.PHP_EOL; //48

    $army1 ->addUnit(new Archer());
    $army1 ->addUnit(new Archer());
    $army1 ->addUnit(new Archer());
    $army1 ->addUnit(new Archer());
    echo "FF".$army1->strength.PHP_EOL; //16

    $army2 = new Army();
    $army2->addUnit(new Archer());
    $army2->addUnit(new LaserCannonUnit());
    echo "FF".$army2->strength.PHP_EOL; //48
    $army1->addUnit($army2).PHP_EOL;
    echo "FF".$army1->bombardStrength().PHP_EOL;
    echo "TT".$army1::$Tstrength.PHP_EOL;

$army1->removeUnit($army2);
//$army1->removeUnit($army2);
    echo $army1->bombardStrength().PHP_EOL;

