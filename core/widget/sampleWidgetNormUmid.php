<?php

use zetsoft\models\page\PageAction;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZGrapesJsWidgetUmid;
use zetsoft\widgets\notifier\ZSweetAlert2Widget;

$action = new WebItem();
$action->debug = false;

Az::$app->controller->layout = 'grapes';

$actionId = $this->httpGet('key');
$PageAction = PageAction::findOne($actionId);

$name = 'core/kernel/widget/class';

if ($PageAction)
    $name = $PageAction->name;

$path = Root . '/webhtm/' . $name . '.php';
$path = str_replace('\\', '/', $path);


$assets = $this->viewAsset($path);
$pregs = Az::$app->utility->pregs;

$scripts = ZArrayHelper::getValue($pregs->pregMatchAll($assets, '<script src="(.*?)".*?>'), 1);
$links = ZArrayHelper::getValue($pregs->pregMatchAll($assets, '<link href="(.*?)".*?>'), 1);

/*
 *
 *  0 => "/vendor/select2/select2/dist/css/select2.css"
  1 => "/vendor\kartik-v\yii2-widget-select2\src/assets/css/select2-addl.css"
  2 => "/vendor\kartik-v\yii2-widget-select2\src/assets/css/select2-classic.css"
  3 => "/vendor\kartik-v\yii2-krajee-base\src/assets/css/kv-widgets.css"
]*/

$page = $this->renderFile($path);

ZGrapesJsWidgetUmid::begin([
    'config' => [
        'lang' => ZGrapesJsWidgetUmid::langs['uz'],
        'scripts' => [
            '/vendor/select2/select2/dist/js/select2.full.js',
            '/vendor\kartik-v\yii2-widget-select2\src/assets/js/select2-krajee.js',
            '/vendor/select2/select2/dist/js/i18n/ru.js',
        ],
        'styles' => [
            '/vendor/select2/select2/dist/css/select2.css',
            '/vendor\kartik-v\yii2-widget-select2\src/assets/css/select2-addl.css',
            '/vendor\kartik-v\yii2-widget-select2\src/assets/css/select2-classic.css',
            '/vendor\kartik-v\yii2-krajee-base\src/assets/css/kv-widgets.css',
        ],
        'categories' => [
            'consts',
            'columns',
            'blocks',
            'former',
            'inputes',
            'charts',
            'notifier'
        ],
        'saveFile' => $path
    ],
    'event' => [
        'ready' => <<<JS
        function (event) {
        }
JS

    ]
]);

echo $page;

ZGrapesJsWidgetUmid::end();
$this->title = Az::l('Конструктор сайтов');
