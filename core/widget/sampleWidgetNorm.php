<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\page\PageAction;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\former\ZGrapesJsWidget;
use zetsoft\widgets\former\ZGrapesJsWidgetExample;
use zetsoft\widgets\former\ZGrapesJsWidgetOtabek;
use zetsoft\widgets\former\ZGrapesJsWidgetRav;
use zetsoft\widgets\former\ZGrapesJsWidgetRavshanNorm;
use zetsoft\widgets\notifier\ZSweetAlert2Widget;

/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Главная страница';
$action->icon = 'fa fa-area-chart';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = false;

$action->cache = false;

$action->call = [
//    TagDependency::invalidate()
];
$action->cacheHttp = false;

$this->paramSet(paramAction, $action);

$this->title();

$this->beginPage();
?>
    <!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>

        <?php
        require Root . '/webhtm/block/metas/'. App .'/main.php';
        require Root . '/webhtm/block/assets/'. App .'/main.php';

        $this->head();
        ?>

    </head>
<body class="<?= ZWidget::skin['white-skin'] ?>">
<?php

$this->beginBody();

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

Az::$app->params['grape'] = true;

$page = $this->requireAjaxFilePreg($path);


ZGrapesJsWidgetRav::begin([
    'config' => [
        'scripts' => $scripts,
        'styles' => $links,
        'categories' => [
            'former',
            'inputes',
            'columns'
        ],
        'saveFile' => $path
    ]
]);

echo $page;

ZGrapesJsWidgetRav::end();

$this->title = Az::l('Конструктор сайтов');
