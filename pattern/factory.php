<?php
    /**
     * factory pattern
     * Created by PhpStorm.
     * User: Administrator
     * Date: 2019/3/24 0024
     * Time: 15:41
     */

    abstract class ApptEncoder{
        abstract function encoder();
    }
     class BloggsApptEncoder extends ApptEncoder{
        public function encoder() {
            // TODO: Implement encoder() method.
            return "Appointment data encoded in BloggsCal Format\n";
        }
     }
    class MegaApptEncoder extends ApptEncoder{
        public function encoder() {
            // TODO: Implement encoder() method.
            return "Appoint data encoded in MegaCal formant \n";
        }
    }
    class CommsManager{
        const BLOGGS=1;
        const MEGA=2;
        private $mode=1;
        function __construct($mode) {
            $this->mode=$mode;
        }

        function getApptEncoder(){
            switch($this->mode){
                case (self::MEGA):
                    return new MegaApptEncoder();
                    break;
                default:
                    return new BloggsApptEncoder();
                    break;
            }
        }
    }

    $comms = new CommsManager(CommsManager::MEGA);
    $apptEncoder = $comms->getApptEncoder();
    print $apptEncoder->encoder();





























