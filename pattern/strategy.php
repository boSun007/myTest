<?php
    /**
     * Created by PhpStorm.
     * User: Administrator
     * Date: 2019/3/24 0024
     * Time: 13:23
     */
    abstract class Lesson {
        private $duration;
        private $costStrategy;
        public function __construct($duration, CostStrategy $strategy) {
            $this->duration = $duration;
            $this->costStrategy = $strategy;
        }
        function cost() {             return $this->costStrategy->cost($this); }
        function chargeType() {         return $this->costStrategy->chargeType(); }
        public function getDuration() { return $this->duration;}
    }

    class Lecture extends Lesson {    }

    class Seminar extends Lesson {    }

    abstract class CostStrategy {
        abstract function cost(Lesson $lesson);
        abstract function chargeType();
    }

    class TimedCostStrategy extends CostStrategy {

        function cost(Lesson $lesson) {
            return ($lesson->getDuration() * 5);
        }

        function chargeType() {
            return "hourly rate";
        }
    }

    class FixedCostStrategy extends CostStrategy {

        function cost(Lesson $lesson) {
            return 30;
        }

        function chargeType() {
            return "fixed rate";
        }
    }

    $lessons[] = new Seminar(4, new TimedCostStrategy());
    $lessons[] = new Lecture(4, new FixedCostStrategy());
    foreach ($lessons as $lesson){
        print "lesson charge: {$lesson->cost()}".PHP_EOL;
        print "chargeType: {$lesson->chargeType()}";
    }













