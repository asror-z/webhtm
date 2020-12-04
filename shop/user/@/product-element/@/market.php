<?php

use zetsoft\dbitem\shop\ProductItem;
use zetsoft\dbitem\chat\ReviewItem;
use zetsoft\dbitem\shop\SingleProductItem;
use zetsoft\dbitem\data\ALLApp;
use zetsoft\dbitem\data\Form;
use zetsoft\dbitem\data\TabItem;
use zetsoft\service\forms\Active;
use zetsoft\service\forms\ZPjax;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\widgets\cards\ZHorizontalWidgetUMiD;
use zetsoft\widgets\cards\ZTouchSpPriceWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\inputes\ZInputWidget;
use zetsoft\widgets\inputes\ZKStarRatingWidget;
use zetsoft\widgets\inputes\ZMImageRadioGroupWidget;
use zetsoft\widgets\market\ZMenuWidget;
use zetsoft\widgets\market\ZMSwiperWidget;
use zetsoft\widgets\market\ZProductPropertyWidget;
use zetsoft\widgets\market\ZReviewWidget;
use zetsoft\widgets\market\ZZoomWpWidget;
use zetsoft\widgets\menus\ZSidebarWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\navigat\ZSlimScrollWidget;
use zetsoft\widgets\themes\ZTabWidget;
use zetsoft\dbitem\core\WebItem;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\market\ZFooterAllWidget;

/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Главная страница';
$action->icon = 'fa fa-area-chart';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;

$action->cache = false;

$action->call = [
//    TagDependency::invalidate()
];
$action->cacheHttp = false;

$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

$item = new ProductItem();
if (!isset($items)){
    $item = new SingleProductItem();
    $item->id = 2;
    $item->name = 'Арахисовая паста с медом 200г';
    $item->title = 'Test Desc';
    $item->new_price = '14825920';
    $item->price_old = '188920';
    $item->barcode = '34234234';
    $item->exist = ProductItem::exists['not'];
    $item->images = [
        'https://images.pexels.com/photos/1095550/pexels-photo-1095550.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500',
        'https://images.pexels.com/photos/461198/pexels-photo-461198.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500',
        'https://previews.123rf.com/images/veneratio/veneratio1511/veneratio151100044/48203428-landscape-iamge-of-river-flowing-through-lush-green-forest-in-summer.jpg',
        'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcRVDh2D2fzRSBYnwaA-70G74wjOeeZWbRnEVBMxfu1jVqcP9fMv&usqp=CAU',
    ];
    $item->currency = 'сум';
    $item->currencyType = 'after';
    $item->measure = 'шт';
    $item->rating = 3.5;
    $item->discount = -10;
    $item->catalogId = 19;
    $item->sale = 'sdadsa';
    $item->is_multi = false;
    $item->in_wish = true;
    $item->in_compare = false;
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

<?
$this->beginBody();


require Root . '/webhtm/block/header/main.php';
require Root . '/webhtm/block/navbar/main.php';

$product_id = $this->httpGet('id');

//$reviews = Az::$app->market->review->getReviewByProductId($product_id);
//$reviewItem = '';
$reviewItem = '';
$reviews=[];


//vdd(Az::$app->market->review->getReviewByProductId($product_id));
/*if (!isset($reviews)){
    foreach ($reviews as $review) {
        $reviewItem .= $review;
    }
}*/
//

/** @var ZProductItem[] $product */
//todo: service
/*$product = Az::$app->market->product->product(18, 57);
Az::$app->market->wish->writeViewed($product_id);*/
if(!isset($product)){
    $product = new SingleProductItem();
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


?>


<div class="container-fluid bg-white">
    <div class="row py-5">
        <div class="col-lg-6 col-md-12 col-sm-12">
            <div class="row ">
            
                <div class="col-md-6 col-xl-6 col-sm-12 px-3">
                    <?=
                       $this->require('/blocks/SingleProduct/category_menu.php');
                    ?>
                </div>
                <div class="col-md-6 col-xl-6 col-sm-12 ">
                    <div class="d-flex justify-content-center px-5">
                        <?= $this->require('/blocks/SingleProduct/imageZoom.php') ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-12 col-sm-12">
            <div class="row mb-2">
                <div class="col-md-6 col-xl-6 col-sm-12 ">
                    <div class="row px-3">
                        <div class="col-md-12">
                            <h6 class="text-uppercase text-left font-weight-bold fp-20"><?php echo $product->name ?></h6>
                        </div>
                        <div class="col-md-12">
                            <div class="d-flex justify-content-between">
                            <?php
/*                              echo $this->require('/webhtm/shop/market/single/block/star_and_medal.php');
                            * /?>
                            </div>
                        </div>
                       
                    </div>
                    <div class="row">
                        <div class="col-md-12">

                            <?=
                                $this->require('/blocks/SingleProduct/properties.php',['product' => $product]);
                            ?>

                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-6 col-sm-12 px-2">

                    <div class="d-flex justify-content-center flex-column">
                        <?/*=$this->require('/webhtm/shop/market/single/block/wish_and_compare.php', ['product'=>$product]); */?>
                    </div>
                    <div class="d-flex justify-content-center align-items-center " >
<!--                    begin touchspin-->
                            <?/*= $this->require('/render/cards/ZHCommonSaleWidget/demo/jamshid/cleantouch.php', ['product' => $product]);*/?>
<!--                    endspin -->
                    </div>
                    <div class="d-flex justify-content-center align-items-center " >
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 my-2 col-md-12">
            <?
               echo $this->require( '/webhtm/block/SingleProduct/tabItem.php',['product' => $product, 'reviews' => $reviews])
            ?>
        </div>
    </div>
</div>
<div>
    <?=
        $this->require( '/webhtm/block/SingleProduct/footer.php');
    ?>
</div>

<script>
    window.onload = () => {
        loadData();
    };

    let radioBtns = document.querySelectorAll('input[type="radio"]');
    radioBtns.forEach(item => {
        item.addEventListener('click', (event) => {
            loadData();
        })
    });

    function loadData() {
        $.ajax({
            url: '/core/product/getCompany_s_sh.aspx',
            type: 'GET',
            data: $("#formModal").serialize(),
            success: function (data) {
                $('.data').html(data);
                $('.market-company').removeClass('d-none');
                $('.data').addClass('d-none');
                setTimeout(function () {
                    $('.market-company').addClass('d-none');
                    $('.data').removeClass('d-none');
                }, 3000)

                console.log($("#formModal").serialize());
            },
            error:function (event){
                console.log(e);
            }

        });
    }


</script>

    <?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
