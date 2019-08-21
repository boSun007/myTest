<?php
    /**
     * Created by PhpStorm.
     * User: Administrator
     * Date: 2019/3/3 0003
     * Time: 9:04
     */
include "player.php";
include "audioPlayer.php";
include "videoPlayer.php";

    $files=[
        ['file'=>'小夜曲', 'type'=>'mp3'],
        ['file'=>'乐高大电影', 'type'=>'mp4'],
        ['file'=>'love the way you lie', 'type'=>'wma'],
        ['file'=>'蝙蝠侠', 'type'=>'mp5'],
    ];

    $player = new player();
    foreach ($files as $file){
        $player->play($file['file'],$file['type']);
    }

