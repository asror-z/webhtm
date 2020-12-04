<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\shop\ShopBrand;
use zetsoft\models\shop\ShopCatalog;
use zetsoft\models\shop\ShopCategory;
use zetsoft\models\shop\ShopProduct;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZInfinityScrollAjaxWidget;
use zetsoft\widgets\market\ZFooterAllWidget;
use zetsoft\widgets\market\ZMSwiperWidget;
use zetsoft\widgets\notifier\ZJspanelWidget;

/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Главная страница';
$action->icon = 'fa fa-area-chart';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;

$action->cache = false;

$action->call = [];

$action->cacheHttp = false;

$this->paramSet(paramAction, $action);

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
require Root . '/render/menus/ZSidebarWidget/ready/main.php';
require Root . '/webhtm/block/navbar/main.php';

?>
<div class="row">
    <div class="col-xl-3 col-lg-4 col-md-4 col-sm-4 media-category">
        <?
        echo zetsoft\widgets\market\ZMenuWidget::widget([
            'config' => [

                'open' => true,
                'mode' => 'shop'
            ],
        ]);
        ?>
    </div>
</div>
<?php
echo ZInfinityScrollAjaxWidget::widget([
    'config' => [
        'url' => '/shop/admin/core-user/infinity.aspx',
        'requireUrl' => '/render/cards/ZListViewWidget/demo/vertical_horizontal.php',
        'limit' => 6,
        'cols' => 2
    ]
]);
?>
<?php
echo ZFooterAllWidget::widget();

?>

<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
