<?php
    /**
     *  advanced factory pattern
     * Created by PhpStorm.
     * User: Administrator
     * Date: 2019/3/24 0024
     * Time: 15:50
     */
    abstract class ApptEncoder{ abstract function encoder();}
    class BloggsApptEncoder extends ApptEncoder{
        function encoder() {
            // TODO: Implement encoder() method.
            return "Appointment data encode in BloggsCal format \n";
        }
    }
    class MegasApptEncoder extends ApptEncoder{
        function encoder() {
            // TODO: Implement encoder() method.
            return "Appointment data encode in MegasCal format \n";
        }
    }
    abstract class CommsManager{
        abstract function getHeaderText();
        abstract function getFooterText();
        abstract function getApptEncoder();
    }
    class BloggsCommsManager extends CommsManager{
        function getHeaderText() {
            // TODO: Implement getHeaderText() method.
            return "BloggsCal header";
        }
        function getFooterText() {
            // TODO: Implement getFootertext() method.
            return "BloggsCal Footer Text \n";
        }
        function getApptEncoder() {
            // TODO: Implement getApptEncoder() method.
            return new BloggsApptEncoder();
        }
    }
    class MegaCommsManager extends CommsManager{
        function getHeaderText() {
            // TODO: Implement getHeaderText() method.
            return "MegasCal header";
        }
        function getFooterText() {
            // TODO: Implement getFootertext() method.
            return "MegasCal Footer Text \n";
        }
        function getApptEncoder() {
            // TODO: Implement getApptEncoder() method.
            return (new MegasApptEncoder())->encoder();
        }
    }

class myCommsManager extends CommsManager{
        public $header;
        public $footer;
        public $encoder;
        public function __construct(CommsManager $commsManager) {
            $this->encoder = $commsManager->getApptEncoder();
            $this->header = $commsManager->getHeaderText();
            $this->footer = $commsManager->getFooterText();
        }
    function getHeaderText() {
        // TODO: Implement getHeaderText() method.
        return $this->header;
    }
    function getFooterText() {
        // TODO: Implement getFootertext() method.
        return $this->footer;
    }
    function getApptEncoder() {
        // TODO: Implement getApptEncoder() method.
        return $this->encoder;
    }

}

$commsManger = new myCommsManager(new MegaCommsManager());
echo $commsManger->getApptEncoder();






