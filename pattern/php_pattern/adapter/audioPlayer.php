<?php
    /**
     * Created by PhpStorm.
     * User: Administrator
     * Date: 2019/3/3 0003
     * Time: 9:02
     */
include "audioInterface.php";
    class audioPlayer implements audioInterface {
        public function play($file) {
            // TODO: Implement playAudio() method.
            echo "playing Audio File: ".$file;
        }
    }