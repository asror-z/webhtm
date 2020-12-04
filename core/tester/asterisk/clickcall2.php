<?php

use zetsoft\dbitem\elfin\ElfinderItem;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\blocks\ZElfinderWidget;
use zetsoft\widgets\blocks\ZElfinderWidget2;


/** @var ZView $this */


$data = [];

$item = new ElfinderItem();
$item->path = Root . '/render';
$item->url = '/render';
$data[] = $item;

$item = new ElfinderItem();
$item->path = Root . '/webhtm';
$item->url = '/webhtm';
$data[] = $item;

echo ZElfinderWidget::widget([
    'config' => [
        'type' => ['text/x-php', 'text/html', 'directory'],
        'path' => Root . '/render',
    ],
    'data' => $data
]);

