<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\page\PageAction;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZGrapesJsWidget;
use zetsoft\widgets\former\ZGrapesJsWidgetAbdulloh;
use zetsoft\widgets\former\ZGrapesJsWidgetMalikaa;
use zetsoft\widgets\former\ZGrapesJsWidgetNorm;
use zetsoft\widgets\former\ZGrapesJsWidgetOtabek;
use zetsoft\widgets\former\ZGrapesJsWidgetRav;
use zetsoft\widgets\former\ZGrapesJsWidgetSalohiddin;
use zetsoft\widgets\former\ZGrapesJsWidgetShakhrizod;
use zetsoft\widgets\former\ZGrapesJsWidgetUmid;
use zetsoft\widgets\inputes\ZKSelect2Widget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\menus\ZMmenuWidgetSh;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\auto\Auto;


/** @var ZView $this */

/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Grapes';
$action->icon = 'fal fa-calendar-edit';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->cache = false;
$action->toolbar = false;
$action->debug = false;
$action->call = null;
$action->loader = null;
$action->cacheHttp = false;

$this->paramSet(paramAction, $action);

$this->title();

$this->paramSet('widget', true);

/**
 *
 * Start Page
 */


$this->beginPage();
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>

    <?php

    require Root . '/webhtm/block/metas/main.php';
    require Root . '/webhtm/block/assets/main.php';

    $this->head();

    ?>

</head>


<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php

$this->beginBody();


$dfPath = $this->httpGet('path');
$path = Root . '/webhtm/' . App . $dfPath;
$path = str_replace('/', '\\', $path) . '.php';

$pageArray = $this->requirePartGrape($path);

$file = ZArrayHelper::getValue($pageArray, 'file');
$scripts = ZArrayHelper::getValue($pageArray, 'scripts');
$links = ZArrayHelper::getValue($pageArray, 'links');

ZGrapesJsWidgetRav::begin([
    'config' => [
        'saveFile' => $path,
        'scripts' => $scripts,
        'styles' => $links,
        'categories' => [
            'former',
            'inputes',
            'columns',
        ],
    ]
]);

//$this->paramSet('grape', true);
echo $file;

ZGrapesJsWidgetRav::end();

$this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
