<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

use FontLib\Table\Type\name;
use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\shop\ProductItem;
use zetsoft\dbitem\shop\PropertyItem;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\cards\ZHMarketSuggestion;
use zetsoft\widgets\navigat\ZYandexTabWidget;

/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Мониторинг';
$action->icon = 'fa fa-area-chart';
$action->type = WebItem::type['ajax'];
$action->csrf = true;
$action->debug = true;

$action->cache = false;
$action->cacheHttp = false;

$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

$product = new ProductItem();

/*$product_id = $this->httpGet('id');
$reviews = Az::$app->market->review->getReviewByProductId($product_id);*/
$reviews = [];


/** @var ProductItem[] $product */
/*$product = Az::$app->market->product->getproducttest();*/

if (!isset($product) || empty($product)) {
    /** @var PropertyItem[] $productProperty */
    $productProperty = [];

    $property = new PropertyItem();

    $property->name = 'asdasd';
    $property->branch = 'asdasd';
    $property->items = [];

    $productProperty[] = $property;

    $product->id = 2;
    $product->name = 'Арахисовая паста с медом 200г';
    $product->title = 'Test Desc';
    $product->new_price = '14825920';
    $product->price_old = '188920';
    $product->barcode = '34234234';
    $product->exist = ProductItem::exists['not'];
    $product->image = [
        'https://images.pexels.com/photos/1095550/pexels-photo-1095550.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500',
        'https://images.pexels.com/photos/461198/pexels-photo-461198.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500',
        'https://previews.123rf.com/images/veneratio/veneratio1511/veneratio151100044/48203428-landscape-iamge-of-river-flowing-through-lush-green-forest-in-summer.jpg',
        'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcRVDh2D2fzRSBYnwaA-70G74wjOeeZWbRnEVBMxfu1jVqcP9fMv&usqp=CAU',
    ];
    $product->currency = 'сум';
    $product->currencyType = 'after';
    $product->measure = 'шт';
    $product->rating = 3.5;
    $product->discount = -10;
    $product->catalogId = 19;
    $product->sale = 'sdadsa';
    $product->is_multi = false;
    $product->in_wish = true;
    $product->in_compare = false;
}

$item = new ProductItem();
$item->id = 2;
$item->name = 'Арахисовая паста с медом 200г';
$item->title = 'Test Desc';
$item->new_price = '99 000';
$item->price_old = '100 000';
$item->barcode = '34234234';
$item->exist = ProductItem::exists['not'];
$item->images =
    'https://images.pexels.com/photos/1095550/pexels-photo-1095550.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500';
$item->currency = 'сум';
$item->currencyType = 'after';
$item->measure = 'шт';
$item->rating = 3.5;
$item->discount = -10;
$item->catalogId = 19;
$item->max_price = 2155632;
$item->sale = 'sdadsa';
$item->is_multi = false;
$item->min_price = 'adssad';
$item->in_wish = true;
$item->in_compare = false;
$item->cart_amount = 0;

$item->review = 400;
$item->delivery_cost = 'Бесплатно';
$item->productColor = 'белый';

$items[] = $item;

/** @var PropertyItem[] $productProperty */

//$productProperty = [];

/*$service = Az::$app->market->product->product($product_id);
if ($service !== null)
    $productProperty = $service->allProperties;
Az::$app->market->wish->writeViewed($product_id);*/


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
echo $this->require( '/render/market/ZYandexSingleProductHeaderWidget/ready/single-product-header.php');
?>

<div class="container-fluid mt-5">
    <?


    echo $this->require( '/webhtm/shop/user/product-single/block/yandexTab.php',);
    ?>
    <div class="row my-3">

            <?
            echo $this->require( '/webhtm/shop/user/product-single/block/blockMonitoring.php', ['item' => $item]);
            ?>

    </div>
</div>
<?php
echo $this->require( '/webhtm/block/SingleProduct/footer.php');
$this->endBody()
?>
</body>
</html>
<?php $this->endPage() ?>






