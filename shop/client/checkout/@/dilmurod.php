<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\shop\ProductItem;
use zetsoft\models\calls\CallsCdr;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\market\ZFooterAllWidget;
use zetsoft\widgets\market\ZFooterAllWidgetOrg;
use zetsoft\widgets\navigat\ZBreadcrumbsWidget;
use zetsoft\widgets\navigat\ZReadMoreWidget;
use zetsoft\widgets\notifier\ZJspanelWidget;
use zetsoft\widgets\animo\ZFakeLoaderNewWidget;


/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Звонки колл центра';
$action->icon = 'fa fa-area-chart';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;

$action->cache = false;

$action->call = [];

$action->cacheHttp = false;

$this->paramSet(paramAction, $action);


/*$product = Az::$app->market->product->product($product_id, 2, true);*/



$this->title();
$this->toolbar();

/** @var ZView $this */
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
require Root . '/webhtm/block/header/main.php';
require Root . '/webhtm/block/navbar/main.php';
require Root . '/render/menus/ZSidebarWidget/ready/main.php';


$model = new CallsCdr();
echo ZDynaWidget::widget([
    'model' => $model,
    'config' => [
        'cdr' => true
    ],
]);
?>





<?php
echo ZFooterAllWidgetOrg::widget();
echo ZJspanelWidget::widget([]);

?>
<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
