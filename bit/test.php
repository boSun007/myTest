<?php

class LightControl
{
    const TURN_ON_ALL = 0b11111;
    const KITCHEN     = 0b10000;
    const SECOND_LIE  = 0b01000;
    const DINING_ROOM = 0b00100;
    const LIVING_ROOM = 0b00010;
    const MASTER_ROOM = 0b00001;

    private $options;

    public function __construct($options = 0)
    {
        $this->options = $options;
        echo '主卧', "\t";
        echo '客厅', "\t";
        echo '餐厅', "\t";
        echo '次卧', "\t";
        echo '厨房', "\t", PHP_EOL;
    }

    public function getOptions()
    {
        return $this->options;
    }

    public function setOptions($options)
    {
        $this->options = $options;
    }

    public function showOptions()
    {
        echo self::getOption($this->options, self::MASTER_ROOM), "\t";
        echo self::getOption($this->options, self::LIVING_ROOM), "\t";
        echo self::getOption($this->options, self::DINING_ROOM), "\t";
        echo self::getOption($this->options, self::SECOND_LIE), "\t";
        echo self::getOption($this->options, self::KITCHEN);
    }

    //获取指定灯的开关状态
    private static function getOption($options, $option)
    {
        return intval(($options & $option) > 0);
    }
}


$lightControl = new LightControl();
$lightControl->showOptions();
echo PHP_EOL;
$lightControl = new LightControl(LightControl::TURN_ON_ALL);
$lightControl->showOptions();