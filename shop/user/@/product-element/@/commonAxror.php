<?php

use zetsoft\dbitem\shop\MultiProductItem;
use zetsoft\dbitem\shop\ProductItem;
use zetsoft\dbitem\shop\PropertyItem;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\dbitem\core\WebItem;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;

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

$this->fileJs('/render/asrorz/market/js/common.js');

$product_id = $this->httpGet('id');
//$reviews = Az::$app->market->review->getReviewByProductId($product_id);

/** @var ProductItem[] $product */
$product = Az::$app->market->product->product($product_id,null,true);
 // vdd($product);
if(!isset($product) || $product===null){

     
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
    $property2->name = 'Цвет';
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



}

/** @var PropertyItem[] $productProperty */


// todo: remove

/*$productProperty = [];
$service = Az::$app->market->product->product($product_id);
if ($service !== null)
    $productProperty = $service->allProperties;
*/

if (!isset($productProperty) && $product===null) {

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

    echo $this->require( '/render/market/ZYandexSingleProductHeaderWidget/ready/single-product-header.php',[
        'product_id' => $product_id ?? ''
    ]);

    echo $this->require( '/webhtm/shop/user/product-single/block/yandexTabAxror.php',);
    ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card-title">
                <? //$this->pjaxBegin(); ?>
                <?

                echo $this->require( '/webhtm/shop/@/product-market/block/tab_productAxror.php', [
                   // 'productProperty' => $productProperty,
                    'product' => $product,
                ]);
                ?>

            </div>
        </div>
    </div>
    <hr>



</div>


<?php
echo $this->require( '/webhtm/block/SingleProduct/footer.php');
?>

<?/*

echo $this->require( '/webhtm/shop/user/product/block/suggestions.php');

*/?>






<script>
    common();

    /*window.onload = () => {
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
    });*/
</script>

<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
