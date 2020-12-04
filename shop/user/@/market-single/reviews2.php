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
use zetsoft\dbitem\chat\ReviewItem;
use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\shop\ProductItem;
use zetsoft\dbitem\shop\PropertyItem;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\navigat\ZYandexTabWidget;

/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Отзывы';
$action->icon = 'fa fa-area-chart';
$action->type = WebItem::type['ajax'];
$action->csrf = true;
$action->debug = true;

$action->cache = false;
$action->cacheHttp = false;

$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

$item = new ProductItem();

$company_id = $this->httpGet('id');



/** @var ProductItem[] $product */
//$product = Az::$app->market->product->product($company_id);

if (!isset($product) || empty($product)) {
    $product = new ProductItem();
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
    $product->max_price = 2155632;
    $product->sale = 'sdadsa';
    $product->is_multi = false;
    $product->min_price = 'adssad';
    $product->in_wish = true;
    $product->in_compare = false;
}

/** @var PropertyItem[] $productProperty */
if ($product !== null)
    $productProperty = $product->allProperties;

//Az::$app->market->wish->writeViewed($company_id);


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


$this->fileJs('/webhtm/shop/user/market-single/asset/new.js');


require Root . '/webhtm/block/header/main.php';
require Root . '/webhtm/block/navbar/main.php';
echo $this->require( '/render/market/ZYandexSingleProductHeaderWidget/ready/single-company-header.php');
?>

<div class="container-fluid">
    <?php
    echo $this->require( '/webhtm/shop/user/market-single/block/yandexTab.php',
    [
        'company_id' => $company_id,
        'type' => 'company'
    ]
    )
    ?>
    <div class="row">
        <div class="col-lg-10">

            <?php

                echo $this->require( '/webhtm/shop/user/item-review/review-company.php', ['company_id' => $company_id]);
       

            ?>

        </div>
    </div>
</div>

<div>
    <?=
    $this->require( '/webhtm/block/SingleProduct/footer.php');
    ?>
</div>

<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>








