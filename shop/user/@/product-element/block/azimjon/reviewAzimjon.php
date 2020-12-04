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

$product_id = $this->httpGet('id');

//$reviews = Az::$app->market->review->getReviewByProductId($product_id);
if (!isset($company)) {
    $reviewItems = [];
    $reviewItem = new ReviewItem();
    $reviewItem->id = '20';
    $reviewItem->product_id = '10';
    $reviewItem->user_name = 'kennyS';
    $reviewItem->user_image = 'https://static-01.daraz.pk/p/83b3c9646204ea3de622893858c80f25.jpg';
    $reviewItem->text = ' Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem inventore ipsa maiores officia possimus provident? Aspernatur culpa cupiditate distinctio, eius enim eos molestiae nisi odio perspiciatis placeat provident qui quibusdam reprehenderit soluta ullam, voluptas voluptatum? Aperiam maxime nesciunt odio vitae.';
    $reviewItem->photo = 'https://static-01.daraz.pk/p/83b3c9646204ea3de622893858c80f25.jpg';
    $reviewItem->rating = 3;
    $reviewItem->rating_option = 3;
    /*$reviewItem->experience = $core_review->experience;
    $reviewItem->recommend = $core_review->recommend;
    $reviewItem->anonymous = $core_review->anonymous;
    $reviewItem->like = $core_review->like;
    $reviewItem->created_at = $core_review->created_at;
    $reviewItem->virtues = $core_review->virtues;
    $reviewItem->drawbacks = $core_review->drawbacks;
    $reviewItem->dislike = $core_review->dislike;
    $reviewItem->type = $core_review->type;*/
    $reviewItem->isdislike = true;
    $reviewItem->islike = false;

    $reviewItems[] = $reviewItem;

}




/** @var ProductItem[] $product */
//$product = Az::$app->market->product->product($product_id);
if (!isset($product)) {
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

Az::$app->market->wish->writeViewed($product_id);


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

<div class="container">
    <?
    echo $this->require( '/render/market/ZYandexSingleProductHeaderWidget/ready/single-product-header.php')
    ?>
    <?php
    echo $this->require( '/webhtm/shop/user/product/block/yandexTab.php',)
    ?>
    <div class="row">
        <div class="col-lg-10">
              
            <?php
            echo $this->require( '/webhtm/shop/user/review/review-product.php', ['product_id' => $product->id]);
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








