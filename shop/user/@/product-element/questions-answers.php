<?php

use rmrevin\yii\fontawesome\FA;
use zetsoft\dbitem\shop\MultiProductItem;
use zetsoft\dbitem\shop\ProductItem;
use zetsoft\dbitem\shop\PropertyItem;
use zetsoft\dbitem\chat\ReviewItem;

use zetsoft\system\Az;
use zetsoft\dbitem\core\WebItem;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;

/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Вопросы и ответы';
$action->icon = 'fa fa-area-chart';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = false;

$action->cache = false;
$action->cacheHttp = false;

$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

$product_id = $this->httpGet('id');

if($product_id===null)
    echo 'Product Id is Required';

$reviews = Az::$app->market->review->getReviewByProductId($product_id);


/** @var ZProductItem[] $product */
$product = Az::$app->market->product->product($product_id);

if (!isset($reviews) || $reviews===null){

    $review = new ReviewItem();

}

if (!isset($product) || $product ===null) {
    $product = new MultiProductItem();
    $product->id = '17';
    $product->catalogId = '19';
    $product->name = 'Product Name';
    $product->amount = 0;
    $product->status = ['sale', 'top'];
    $product->categoryId = '12';
    $product->categoryName = 'name category';
    $product->categoryUrl = 'market.ru';
    $product->title = 'lorem';
    $product->text = 'lore';
    $product->brand = 'Samsung';
    $product->brandImage = '';
    $product->rating = 3;
    $product->reviewCount = 0;
    $product->exist = 'yeds';
    $product->url;
    $product->visible = true;
    $product->image = [];
    $product->is_multi;
    $product->in_wish;
    $product->in_compare;
    $product->currency = 'cум';
    $product->currencyType = 'after';
    $product->cart_amount;
    $product->items = [];
    $product->barcode;
    $product->measure = 'kg';
    $product->measureStep = 'pcs';
    $product->min_price = 213;
    $product->max_price = 54645;
    $product->is_multi = true;
}

/** @var PropertyItem[] $productProperty */
/*$productProperty = [];
$service = Az::$app->market->product->product($product_id);
if ($service !== null)
    $productProperty = $service->allProperties;
Az::$app->market->wish->writeViewed($product_id);*/

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
<div class="container-fluid">
    <div class="row">
        <?
        echo $this->require( '/render/market/ZYandexSingleProductHeaderWidget/ready/single-product-header.php')
        ?>
        <div class="col-12 mb-3">
            <?


            echo $this->require( '/webhtm/shop/user/product-single/block/yandexTab.php',[
                'id' => $product_id,
                'type' => 'product',

            ]);
            ?>
        </div>
        <div class="col-12">
            <?
            echo $this->require( '/webhtm/shop/user/product-single/block/question-answer.php',
                ['product_id' => $product_id]);
            ?>
        </div>


    </div>



</div>


<?php
echo $this->require( '/webhtm/block/SingleProduct/footer.php');
?>



<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>

