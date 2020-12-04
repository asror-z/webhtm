<?php

use rmrevin\yii\fontawesome\FA;
use zetsoft\dbitem\shop\ProductItem;
use zetsoft\dbitem\shop\PropertyItem;
use zetsoft\dbitem\chat\ReviewItem;
use zetsoft\dbitem\data\ALLApp;
use zetsoft\dbitem\data\Config;
use zetsoft\dbitem\data\Form;
use zetsoft\dbitem\data\TabItem;
use zetsoft\service\forms\Active;
use zetsoft\service\forms\ZPjax;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\widgets\cards\ZMiniStoreWidget;
use zetsoft\widgets\former\ZAjaxWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\inputes\ZInputWidget;
use zetsoft\widgets\inputes\ZKStarRatingWidget;
use zetsoft\widgets\inputes\ZKTouchSpinWidget;
use zetsoft\widgets\inputes\ZMImageRadioCompanyWidget;
use zetsoft\widgets\inputes\ZMImageRadioGroupWidget;
use zetsoft\widgets\market\ZMenuWidget;
use zetsoft\widgets\market\ZMSwiperWidget;
use zetsoft\widgets\market\ZProductPropertyWidget;
use zetsoft\widgets\market\ZReviewWidget;
use zetsoft\widgets\market\ZZoomWpWidget;
use zetsoft\widgets\menus\ZSidebarWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\navigat\ZSlimScrollWidget;
use zetsoft\widgets\navigat\ZYandexTabWidget;
use zetsoft\widgets\themes\ZTabWidget;
use zetsoft\dbitem\core\WebItem;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\market\ZFooterAllWidget;
use PhpOffice\PhpSpreadsheet\Shared\OLE\PPS\Root;
use zetsoft\widgets\navigat\ZSmartTabWidget;

/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Цены';
$action->icon = 'fa fa-area-chart';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;

$action->cache = false;
$action->cacheHttp = false;

$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

$item = new ZProductItem();

$product_id = $this->httpGet('id');
$reviews = Az::$app->market->review->getReviewByProductId($product_id);

/** @var ZProductItem[] $product */
$product = Az::$app->market->product->getproducttest();

/** @var PropertyItem[] $productProperty */
$productProperty = [];
$service = Az::$app->market->product->product($product_id);
if ($service !== null)
    $productProperty = $service->allProperties;
Az::$app->market->wish->writeViewed($product_id);


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

<?
$this->beginBody();


require Root . '/webhtm/block/header/main.php';
require Root . '/webhtm/block/navbar/main.php';

?>
<?
echo $this->require( '/render/market/ZYandexSingleProductHeaderWidget/ready/single-product-header.php')
?>


<div>
    <?php
    echo $this->require( '/webhtm/shop/user/product/block/yandexTab.php',)
    ?>
</div>
<div class="mt-1">
    <div class="market-container">


        <div class="row">


            <div class="col-md-9">
                <?= $this->require( '/webhtm/shop/user/product/block/company-price.php') ?>
            </div>

            <div class="col-md-2">

            </div>
        </div>
        <div class="row">
            <div class="col-md-12 bg-white py-2">
                <?php
                echo $this->require( '/webhtm/block/SingleProduct/stars.php', ['product' => $product]);
                ?>
            </div>
        </div>


    </div>
</div>


<?php

?>
<div>
    <?=
    $this->require( '/webhtm/block/SingleProduct/footer.php');
    ?>
</div>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
