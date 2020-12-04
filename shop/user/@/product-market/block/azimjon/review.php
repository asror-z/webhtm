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
use zetsoft\widgets\navigat\ZYandexTabWidget;

/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Главная страница';
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

$reviews = Az::$app->market->review->getReviewByProductId($product_id);



/** @var ProductItem[] $product */
$product = Az::$app->market->product->product($product_id);

/** @var PropertyItem[] $productProperty */
$productProperty = Az::$app->market->product->product($product_id)->allProperties;

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

<?php
$this->beginBody();


$product_id = $this->httpGet('id');


/** @var ProductItem[] $product */
$product = Az::$app->market->product->product($product_id);

/** @var PropertyItem[] $productProperty */
$productProperty = Az::$app->market->product->product($product_id)->allProperties;

?>
<?

echo ZYandexTabWidget::widget([
    'data' => [
        'Описание' => '/shop/user/product/single-productAbdulloh.aspx?id=' . $product_id,
        'Характеристика' => '/shop/user/product/single_product_characteristics.aspx?id=' . $product_id,
        'Цены' => '',
        'Отзыви' => '',
        'Вопросы и ответы' => '',
        'Карта' => ''
    ]
]);
?>
<div class="container">
    <div class="row">
        <div class="col-lg-10">
            <div><h4>Общие характеристики</h4></div>
            <?php
            echo $this->require( '/webhtm/shop/user/review/review-product.php', ['product_id' => $product_id]);
            ?>
        </div>
    </div>
</div>

<script>
    $('.w4').addClass('active');

</script>




