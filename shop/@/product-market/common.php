<?php

use rmrevin\yii\fontawesome\FA;
use zetsoft\dbitem\shop\MultiProductItem;
use zetsoft\dbitem\shop\ProductItem;
use zetsoft\dbitem\chat\ReviewItem;
use zetsoft\dbitem\data\ALLApp;
use zetsoft\dbitem\data\Config;
use zetsoft\dbitem\data\Form;
use zetsoft\dbitem\data\TabItem;
use zetsoft\dbitem\shop\PropertyItem;
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

$action->title = Azl . 'Описание';
$action->icon = 'fa fa-area-chart';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;

$action->cache = false;
$action->cacheHttp = false;

$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

$product_id = $this->httpGet('id');
//$reviews = Az::$app->market->review->getReviewByProductId($product_id);

/** @var ProductItem[] $product */
//$product = Az::$app->market->product->product($product_id);
$property = new PropertyItem();
$property->branch = 'general';
$property->name = 'Память';
$property->items = [
    12 => '128GB',
    18 => '64GB',
    9 => '512GB'
];
$property2 = new PropertyItem();
$property2->branch = 'general2';
$property2->name = 'Цветь';
$property2->items = [
    1 => 'Красный',
    18 => 'Чёрный',
    9 => 'Белый'
];
$property3 = new PropertyItem();
$property3->branch = 'general3';
$property3->name = 'Оперативная память';
$property3->items = [
    9 => '8GB',
];

$product = new MultiProductItem();

$product->id = 18;
$product->catalogId = 19;
$product->name = 'Product Name';
$product->amount = 0;
$product->properties = [
    $property,
    $property2,
    $property3,
];
/*$product->allProperties = [
    $property
];*/
$product->status = ['new', 'hot_)', 'sale'];
$product->categoryId = 20;
$product->categoryName = 'catalogName';
$product->categoryUrl = '';
$product->title = '';
$product->text = '';
$product->brand = '';
$product->brandImage = '';
$product->rating = '';
$product->reviewCount = 8;
$product->url = '';
$product->visible = true;
$product->image = [];
$product->is_multi = true;
$product->in_wish = '';
$product->in_compare = '';
$product->cart_amount = '';
$product->items = [];
$product->barcode = '';
$product->max_price = 5200;
$product->min_price = 4500;


/** @var PropertyItem[] $productProperty */


// todo: remove

/*$productProperty = [];
$service = Az::$app->market->product->product($product_id);
if ($service !== null)
    $productProperty = $service->allProperties;
*/

if (!isset($productProperty)) {

    $service = new MultiProductItem();
    $service->text = 'sadfasd';
    $service->title = 'sadfasd title';


    $service->allProperties[] = $property;
    $service->allProperties[] = $property2;
    $service->allProperties[] = $property3;

    $productProperty = $service->allProperties;

}

/*Az::$app->market->wish->writeViewed($product_id);*/


if ($product === null) {
    ?>
    <div class="mt-5">
        <div class="text-center d-block">

            <i class="far fa-heart fa-10x text-light"></i>

            <h3 class="mt-5 text-muted">
                <?= Az::l('Ваш список избранных товаров пуст,') ?>
            </h3>

            <p class="text-muted">
                <?= Az::l('Добавьте товары в избранное, чтобы понравившиеся товары были всегда под рукой.') ?>
            </p>
            <br>

            <?
            echo ZButtonWidget::widget([
                'config' => [
                    'text' => 'Перейти к покупкам',
                    'color' => ZColor::color['green'],
                    'class' => '',
                    'url' => '/shop/user/main/index.aspx',
                    'btnStyle' => ZButtonWidget::btnStyle['btn-success'],
                    'btnSize' => ZColor::btnSize['btn-md'],
                    'btnFontSize' => ZButtonWidget::btnScale['0.5'],
                    'btnRounded' => false,
                ],

            ]);
            ?>
        </div>
    </div>
    <?php
    return null;
}


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

?>

<div class="container-fluid mt-3">
    <?
    echo $this->require( '/render/market/ZYandexSingleProductHeaderWidget/ready/single-product-header.php');

    echo $this->require( '/webhtm/shop/user/product/block/yandexTab.php',);
    ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card-title">
                <? //$this->pjaxBegin(); ?>
                <?
                echo $this->require( '/webhtm/shop/user/product/block/tab_product.php', [
                    'productProperty' => $productProperty,
                    'product' => $product
                ]);

                /*echo ZButtonWidget::widget([
                    'config' => [
                        'url' => '',
                        'hasIcon' => true,
                        'btnType' => ZButtonWidget::btnType['link'],
                        'btnStyle' => ZButtonWidget::btnStyle['none'],
                        'btnRounded' => false,
                        'text' => 'hidden',
                        'pjax' => true,
                        'hidden' => true,
                        'title' => 'Обновление',
                        'ttSize' => ZButtonWidget::ttSize['small'],
                        'ttSide' => ZButtonWidget::ttSide['bottom'],
                        'btn' => false,
                        'class' => 'h-100 p-0 noHover',
                        'iconColor' => 'white',
                        'icon' => 'fp-13 fa fa-' . FA::_SYNC,
                    ],
                    'id' => 'refreshMarketList',
                ]);*/

                //$this->pjaxEnd();
                ?>

            </div>
        </div>
    </div>
    <hr>
</div>

<?

echo $this->require( '/webhtm/shop/user/product/block/footer-callback.php');

?>

<div>
    <?=
    $this->require( '/webhtm/block/SingleProduct/footer.php');
    ?>
</div>

<script>
    window.onload = () => {
        let temp = "<div class='text-danger text-center' id='market-alert'>Для начала необходимо выбрать свойства продукта</div>";
        $('#market_list').append(temp);
        console.log(temp);
    };

    var radioBtns = $(document).find('input[type="radio"]');
    radioBtns.each(function (key, radio) {
        $(radio).click(function () {
            loadData();
            $('#refreshMarketList').click();
        })
    });
</script>

<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
