<?php

use zetsoft\models\page\PageAction;
use zetsoft\models\page\PageBlocks;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZFileHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZGrapesJsWidget;
use zetsoft\widgets\former\ZGrapesJsWidgetRavshan;
use zetsoft\widgets\notifier\ZSweetAlert2Widget;

$action = new WebItem();
$action->debug = false;


$service = Az::$app->App->eyuf->grapes;

$block = PageBlocks::findOne($this->httpGet('block'))->name;
$path = Root . '/webhtm/block/' . $block;

$path = str_replace('\\', '/', $path) . '.php';

$assets = $this->viewAsset($path);

$scripts = $service->getPathAssets($assets, 'scripts');
$styles = $service->getPathAssets($assets);

$page = $this->renderPartFile($path);

ZGrapesJsWidgetRavshan::begin([
    'config' => [
        'saveFile' => $path,
        'scripts' => $scripts,
        'styles' => $styles,
        'categories' => [],
    ]
]);

echo $page;

ZGrapesJsWidgetRavshan::end();

$this->title = Az::l('Конструктор сайтов');
