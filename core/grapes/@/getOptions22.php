<?php

use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZGrapesJsWidgetZafar;

$action = new WebItem();
$action->debug = false;


$service = Az::$app->App->eyuf->grapes;

$path = $service->getViewPath($this->httpGet('key'));
$assets = $this->viewAsset($path);

$scripts = $service->getPathAssets($assets, 'scripts');
$styles = $service->getPathAssets($assets);

$page = $this->renderPartFile($path);

ZGrapesJsWidgetMirbosit::begin([
    'config' => [
        'saveFile' => $path,
        'scripts' => $scripts,
        'styles' => $styles,
        'categories' => [
            'block',
            'columns',
            'inputes',
            'former',
            'menus',
        ],
    ]
]);

echo $page;

ZGrapesJsWidgetMirbosit::end();

$this->title = Az::l('Конструктор сайтов');
