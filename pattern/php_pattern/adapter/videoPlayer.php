<?php
    /**
     * Created by PhpStorm.
     * User: Administrator
     * Date: 2019/3/3 0003
     * Time: 9:18
     */

    include "videoInterface.php";
    class videoPlayer implements videoInterface {
        public function play($file) {
            // TODO: Implement playerVideo() method.
            echo "play the Video: ".$file;
        }
    }