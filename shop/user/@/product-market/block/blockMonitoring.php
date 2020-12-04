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
use zetsoft\widgets\inputes\ZInputWidget;
use zetsoft\widgets\navigat\ZYandexTabWidget;
use zetsoft\widgets\themes\ZCardWidget;

/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Цены';
$action->icon = 'fa fa-area-chart';
$action->type = WebItem::type['ajax'];
$action->csrf = true;
$action->debug = false;

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

if (isset($product) && $product === null) {
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

?>

<div class="container-fluid">

    <div class="row">

        <div class="col-lg-12 col-md-12 col-sm-12" style="height: 300px">

            <div class="d-flex flex-sm-wrap">

                <div class="col-lg-3 col-md-3 col-sm-12">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <?
                        ZCardWidget::begin([
                            'config' => [
                                'title' => 'Оставить заявку',
                                'hasTitle' => false,
                                'type' => ZCardWidget::type['dynCard'],
                            ]
                        ]);
                        ?>
                        <h3 class="text-center">Средняя цена</h3>
                        <h4 class="text-center">14.000 сум</h4>
                        <h6 class="text-muted text-center">20.000 - 15.000 сум</h6>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <p class="text-center">Как только цена на товар снизится,
                            вы сразу об этом узнаете</p>
                    </div>
                   <div class="col-lg-12 col-md-12 col-sm-12">
                        <button class="mb-3 btn btn-success btn-block">Следить за снижением цены</button>
                    </div>

                </div>
                <?
                ZCardWidget::end();
                ?>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="col-lg-12 col-md-12 col-sm-12" style="height: 300px">

                        <?
                        echo $this->require( '/webhtm/shop/user/product-single/block/components/amchart-footer.php');
                        ?>

                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-12">

                    <?
                    ZCardWidget::begin([
                        'config' => [
                            'title' => 'Оставить заявку',
                            'hasTitle' => false,
                            'type' => ZCardWidget::type['dynCard'],
                        ]
                    ]);
                    ?>
                    <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                        <h4>Подскажем когда цена снизится</h4>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                        <p>Введите свою почту и получайте уведомления об изменении цены</p>

                        <?
                        echo ZInputWidget::widget([
                            'config' => [
                                'class' => 'text-center',
                                'placeholder' => 'market_place@mail.ru'
                            ],
                        ]);
                        ?>

                        <button class="btn btn-success btn-block w-100">Отправить </button>
                        <?
                        ZCardWidget::end();
                        ?>


                    </div>

                </div>

            </div>

        </div>
    </div>

</div>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>

