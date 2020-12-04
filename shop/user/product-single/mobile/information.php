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
use zetsoft\dbitem\shop\MultiProductItem;
use zetsoft\dbitem\shop\ProductItem;
use zetsoft\dbitem\shop\PropertyItem;
use zetsoft\models\shop\ShopReview;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\navigat\ZYandexTabWidget;

/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Информация';
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

$product = Az::$app->market->product->product($product_id, null, true);
/** @var ProductItem[] $product */
if (!isset($product) || empty($product)) {
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
    //$product->min_price=213;
    //$product->max_price=54645;
    $product->is_multi = true;
}


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
if(!empty($product_id))
    echo $this->require( '/render/market/ZYandexSingleProductHeaderWidget/ready/single-product-header.php');
?>

<div id="content" class="container-fluid">
    <?if (!empty($product_id)):?>
    <?echo $this->require( '/webhtm/shop/user/product-single/block/yandexTab.php',['id' => $product_id,
        'type' => 'product']);

    ?>

    <div class="row">
        <div class="col-lg-12 pt-3 pb-3">
            <div><h4>Информация</h4></div>
            <div><?= $product->title ?></div>
            <div><?= $product->text ?></div>

        </div>
    </div>
    <?php endif; ?>
    <?
       if(empty($product_id))
         echo $this->require( '/render/market/NotFound/main.php',[
            'item'=>'К сожалению, данные отсутствуют.'
        ]);
    ?>
</div>
<?php
echo $this->require( '/webhtm/block/SingleProduct/footer.php');
$this->endBody()
?>
</body>
</html>
<?php $this->endPage() ?>






