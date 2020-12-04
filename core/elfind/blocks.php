<?php
use zetsoft\dbitem\elfin\ElfinderItem;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\blocks\ZElfinderWidget;
/** @var ZView $this */

$data = [];

$item = new ElfinderItem();
$item->path = Root . '/webhtm/block';
$item->url = '/blocks';
$data[] = $item;

echo ZElfinderWidget::widget([
    'config' => [
        'type' => [
            'text/x-php',
            'text/html',
            'directory',
        ],
        'handler' => ""
    ],
    'data' => $data
]);


