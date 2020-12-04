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
use zetsoft\widgets\former\ZGrapesJsWidgetAbdulloh;
use zetsoft\widgets\former\ZGrapesJsWidgetOb;
use zetsoft\widgets\former\ZGrapesJsWidgetRav;
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


$this->paramSet(paramAction, $action);

$this->title();

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

echo ZNProgressWidget::widget([]);

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
//Az::$app->params['grape'] = true;
$page = $this->requireAjaxFilePreg($path);

vdd($assets);
ZGrapesJsWidgetOb::begin([
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

ZGrapesJsWidgetOb::end();
?>
<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
