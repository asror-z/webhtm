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
use zetsoft\widgets\former\ZGrapesJsWidgetRav;
use zetsoft\widgets\inputes\ZKSelect2Widget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\shop\ShopBrand;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Бренды';
$action->icon = 'fa fa-gift';
$action->type = WebItem::type['ajax'];
$action->csrf = true;
$action->debug = true;



$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();



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

?>

<div id="page">

    <?

    echo ZSessionGrowlWidget::widget();

    ?>

    <div id="content" class="content-footer p-3">


    <?php



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

    ?>


    </div>

</div>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
