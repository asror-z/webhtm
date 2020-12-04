<?php

use zetsoft\models\page\PageAction;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZGrapesJsWidget;
use zetsoft\widgets\notifier\ZSweetAlert2Widget;

$action = new WebItem();
$action->debug = false;


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
vdd($scripts);

/**
 *
 *
 *   0 => "/vendor\yiisoft\yii2/assets/yii.js"
1 => "/vendor/select2/select2/dist/js/select2.full.js"
2 => "/vendor/select2/select2/dist/js/i18n/ru.js"
3 => "/vendor\kartik-v\yii2-widget-select2\src/assets/js/select2-krajee.js"
4 => "/vendor\kartik-v\yii2-krajee-base\src/assets/js/kv-widgets.js"
 *
 */

$page = $this->renderAjaxFile($path);

ZGrapesJsWidget::begin([
    'config' => [
        'categories' => [
            'former',
            'inputes',
            'columns'
        ],
        'saveFile' => $path
    ],
    'event' => [
        'ready' => <<<JS
        function (event) {
          console.log(editor.Canvas());
        }
JS

    ]
]);

echo $page;

ZGrapesJsWidget::end();
$this->title = Az::l('Конструктор сайтов');
