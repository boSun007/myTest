<?php
    /**
     * Created by PhpStorm.
     * User: Administrator
     * Date: 2019/3/3 0003
     * Time: 9:13
     */

    class player {
        private $_playerObj;
        public function play($file,$type){
            switch ($type){
                case "mp3":
                    $this->_playerObj = new audioPlayer();
                    break;
                case "mp4":
                    $this->_playerObj = new videoPlayer();
                    break;
            }
            $this->_playerObj->play($file);
        }
    }