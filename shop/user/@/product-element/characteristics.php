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

$action->title = Azl . 'Характеристика';
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




$product = Az::$app->market->product->product($product_id,null,true);
/** @var ProductItem[] $product */
/*$product = Az::$app->market->product->getproducttest();*/
  if (!isset($product)){
      $product=new MultiProductItem();
       $product->id='17';
       $product->catalogId='19';
       $product->name = 'Product Name';
       $product->amount = 0;
       $product->status = ['sale','top'];
       $product->categoryId='12';
       $product->categoryName='name category';
       $product->categoryUrl='market.ru';
       $product->title='lorem';
       $product->text='lore';
       $product->brand='Samsung';
       $product->brandImage='';
       $product->rating=3;
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

/** @var PropertyItem[] $productProperty */
$productProperty = [];
/*$service = Az::$app->market->product->product($product_id);*/


if (!isset($productProperty) && $product===null) {
    /* $productProperty = $product->allProperties;
 Az::$app->market->wish->writeViewed($product_id);*/

    $product = new MultiProductItem();
    $product->text = 'sadfasd';
    $product->title = 'sadfasd title';


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

    $product->allProperties[] = $property;
    $product->allProperties[] = $property2;
    $product->allProperties[] = $property3;
}
$productProperty = $product->allProperties;
   
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

<div class="container-fluid">
    <?
    echo $this->require( '/render/market/ZYandexSingleProductHeaderWidget/ready/single-product-header.php');
    echo $this->require( '/webhtm/shop/user/product-market/block/yandexTab.php',['id' => $product_id,
        'type' => 'product']);
    ?>

    <div class="row">
        <div class="col-lg-12 pt-5 pb-5">
            <div><h4>Общие характеристики</h4></div>
            <?php
             
            foreach ($productProperty as $prop)
             foreach ($prop as $key => $value){
            ?>
                <div class="d-flex justify-content-between fp-18">
                    <span class="fp-16"><?= $value->name ?>
                        <button type="button" class="btn btn-link p-0 hint--right"
                                aria-label="I'm a tooltip text">
                        <i class="far  fa-question-circle ml-1 text-muted "></i>
                        </button>
                    </span>

                    <span class="flex-grow-1 mr-1" style="border-bottom: 1px dotted lightgray; height: 18px;"></span>
                    <span class="fp-16">
                            <? foreach ($value->items as $_key => $_value) {
                                if (count($value->items) > 1 && !($_key === array_key_first($value->items))) {
                                    echo '/';
                                }
                                echo $_value;
                            }
                            ?>
                    </span>
                </div>
            <? } ?>
        </div>
    </div>
</div>
<div>
    <?=
    require(Root . '/webhtm/block/SingleProduct/footer.php');
    ?>
</div>






