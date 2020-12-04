<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\shop\ProductItem;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZInfinityScrollAjaxWidget;
use zetsoft\widgets\market\ZFooterAllWidget;
use zetsoft\widgets\market\ZFooterAllWidgetOrg;
use zetsoft\widgets\navigat\ZBreadcrumbsWidget;
use zetsoft\widgets\notifier\ZJspanelWidget;


/** @var ZView $this */
$market_id = $this->httpGet('id');
$products = Az::$app->market->product->allProducts(null, $market_id, 0, 10);
$companylist = Az::$app->market->product->allCompanies();


foreach ($companylist as $item) {
    if ($item->id === (int)$market_id)
        $company = $item;

}




$action = new WebItem();

if (!empty($market_id) && !empty($company)) {
    $action->title = Azl . $company->name;
}
$action->icon = 'fa fa-area-chart';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;

$action->cache = false;

$action->call = [];

$action->cacheHttp = false;

$this->paramSet(paramAction, $action);


if (!isset($products)) {

    $item = new ProductItem();
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
    $item->max_price = 2155632;
    $item->sale = 'sdadsa';
    $item->is_multi = false;
    $item->min_price = 'adssad';
    $item->in_wish = true;
    $item->in_compare = false;
    $item->cart_amount = 3;
    $item->status = [
        'sale'
    ];
    $item->url = '/shop/user/product-single/common.aspx?id=';
    $products[] = $item;
    $products[] = $item;
    $products[] = $item;
    $products[] = $item;
    $products[] = $item;
    $products[] = $item;
}

$this->title();
$this->toolbar();

$this->beginPage();
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <?php
    require Root . '/webhtm/block/metas/main.php';
    require Root . '/webhtm/block/assets/main.php';
    //$this->fileJs('/render/asrorz/market/js/main-catalog.js');

    $this->head();

    ?>
</head>
<body class="<?= ZWidget::skin['white-skin'] ?> main-catalog-style">

<?php

$this->beginBody();
require Root . '/webhtm/block/header/main.php';
require Root . '/webhtm/block/navbar/main.php';

?>


<div class="container-fluid bg-white">
    <?
    if (empty($market_id) || empty($company)) :
        echo $this->require( '/render/market/NotFound/main.php', [
            'item' => 'К сожалению, данные отсутствуют.'
        ]);

    else :
    ?>
    <div class="row my-4">
        <div class="col-12 mx-auto d-flex">
            <div class="mx-auto d-flex">
                <!--brand rasmi turadi-->
                <!--<img width="100" height="100" class="mr-3 img-fluid"
                     src="<? /*= '/imagez/mplace/' . ZArrayHelper::getValue($company->photo, 0) */
                ?>" alt="">-->
                <h1><?= $company->name ?></h1>
            <?/*vdd($company)*/?>
            </div>
        </div>
    </div>

</div>
    <div class="container-fluid p-0"
         style="background: url('/render/asrorz/images/Background2.png'); background-size: 100% 100%;">
        <section class="bg-dark mb-1">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light bg-dark">

                    <button class="navbar-toggler bg-white" type="button" data-toggle="collapse"
                            data-target="#navbarTogglerDemo03"
                            aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon text-white"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                        <ul class="navbar-nav mx-auto mt-2 mt-lg-0">
                            <li class="nav-item mr-5">
                                <a class="nav-link fp-20 text-white" href="#" id="mainTo">Главная страница</a>
                            </li>
                            <li class="nav-item mr-5">
                                <a class="nav-link fp-20 text-white" href="#products" id="productsTo">Продукты</a>
                            </li>
                            <li class="nav-item mr-5">
                                <a class="nav-link fp-20 text-white" href="#new" id="newTo">Новинки</a>
                            </li>
                            <li class="nav-item mr-5">
                                <a class="nav-link fp-20 text-white" href="#sale" id="saleTo" tabindex="-1"
                                   aria-disabled="true">Cкидки</a>
                            </li>
                        </ul>

                    </div>
                </nav>
            </div>
        </section>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 p-gfh">
                    <?= $this->require( '/webhtm/shop/user/main-common/block/swiper.php') ?>
                </div>
            </div>
        </div>

        <section class="row m-4">
            <div class="col-lg-6 bg-white d-flex justify-content-center">
                <img class="img-fluid" src="<?= '/imagez/mplace/' . ZArrayHelper::getValue($company->photo, 0) ?>"/>
            </div>
            <div class="col-lg-6 d-flex align-items-center">
                <div class="fp-18">
                    <?= $company->text ?>
                </div>
            </div>
        </section>


        <div class="container">
            <div class="row mb-5" id="products">
                <div class="mx-auto mt-3">
                    <h3 class="">ВЫБРАНО ДЛЯ ВАС</h3>
                </div>
                <div class="col-md-12">
                    <?
                    echo $this->require( '/webhtm/shop/user/main-common/block/swiperNumberOne.php');
                    ?>
                </div>
            </div>


            <div class="row mt-4" id="new">
                <div class="col-12 ml-2 ">
                    <h3><?= Az::l('Новинки') ?><span class="ml-2 badge badge-success shadow-none fe-05">New</span></h3>
                </div>
                <div class="col-12">
                    <div class="row">
                        <?
                                
                        foreach ($products as $product)
                            echo $this->require( '/render/cards/ZVMarketWidget/ready/main_row.php', [
                                'item' => $product,
                                'isCommon' => false
                            ]);
                        ?>
                    </div>
                </div>
            </div>

            <div class="row mt-4" id="sale">
                <div class="col-12">
                    <h3><?= Az::l('Cкидки') ?><span class="ml-4 badge badge-danger shadow-none fe-05"><i
                                    class="fas fa-percent px-1 fe-07"></i></span></h3>
                </div>
                <div class="col-12">
                    <div class="row">
                        <?
                        foreach ($products as $product)
                            echo $this->require( '/render/cards/ZVMarketWidget/ready/main_row.php', [
                                'item' => $product
                            ]);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>


<? endif ?>

<script>    
    $("#mainTo").click(function () {
        $("body,html").animate({
            scrollTop: 0
        }, 800);
    });
    $("#productsTo").click(function () {
        $("body,html").animate({
            scrollTop: $("#products").offset().top
        }, 800);
    });
    $("#newTo").click(function () {
        $("body,html").animate({
            scrollTop: $("#new").offset().top
        }, 800);
    });
    $("#saleTo").click(function () {
        $("body,html").animate({
            scrollTop: $("#sale").offset().top
        }, 800);
    });
</script>

<?php
echo ZFooterAllWidgetOrg::widget();
echo ZJspanelWidget::widget([]);
?>
<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
