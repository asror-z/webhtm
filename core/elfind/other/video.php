<?php

use zetsoft\dbitem\elfin\ElfinderItem;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\blocks\ZElfinderWidget;
use zetsoft\widgets\blocks\ZElfinderWidget2;


/** @var ZView $this */


$data = [];
$item = new ElfinderItem();
$item->path = "d:/Develop/ZVideos/";
$item->url = 'http://learning.zoft.uz:5050/';
$data[] = $item;

echo ZElfinderWidget::widget([
    'config' => [
        'type' => [
            'directory',
            'video/x-dv',
            'video/mp4',
            'video/mpeg',
            'video/x-msvideo',
            'video/quicktime',
            'video/x-ms-wmv',
            'video/x-flv',
            'video/x-matroska',
            'video/ogg'
        ],

        
    ],
    'data' => $data
]);

