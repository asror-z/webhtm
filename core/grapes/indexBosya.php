<?php

use zetsoft\models\page\PageAction;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZGrapesJsWidget;
use zetsoft\widgets\former\ZGrapesJsWidgetRavshan2;
use zetsoft\widgets\former\ZGrapesJsWidgetRavshan;
use zetsoft\widgets\former\ZGrapesJsWidgetRavshanPro;
use zetsoft\widgets\notifier\ZSweetAlert2Widget;

/** @var ZView $this */
/*$action->icon =false;
$this->csrf = false;*/



Az::$app->controller->layout = 'grapes';
$service = Az::$app->App->eyuf->grapes;

$path = $service->getViewPath($this->httpGet('key'));
$assets = $this->viewAsset($path);

$scripts = $service->getPathAssets($assets, 'scripts');
$styles = $service->getPathAssets($assets);


$page = $this->requireAjaxFilePreg($path);

preg_match_all('/<style>(.*?)<\/style>/s', $page, $match);
$cssArray = ZArrayHelper::getValue($match, 1);

$css = '';
foreach ($cssArray as $array) {
    $css .= $array;
}

ZGrapesJsWidgetRavshan::begin([
    'config' => [
        'css' => $css,
        'saveFile' => $path,
        'scripts' => $scripts,
        'styles' => $styles,
        'categories' => [
            'columns',
            'blocks',
            'former',
            'inputes',
        ],
    ]
]);

echo $page;

ZGrapesJsWidgetRavshan::end();

$this->title = Az::l('Конструктор сайтов');
