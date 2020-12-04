<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\shop\ProductItem;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\market\ZFooterAllWidget;
use zetsoft\widgets\market\ZFooterAllWidgetOrg;
use zetsoft\widgets\market\ZMSwiperWidget;
use zetsoft\widgets\navigat\ZBreadcrumbsWidget;
use zetsoft\widgets\navigat\ZReadMoreWidget;
use zetsoft\widgets\notifier\ZJspanelWidget;
use zetsoft\widgets\animo\ZFakeLoaderNewWidget;

/**
 *
 * @license JaloliddinovSalohiddin
 * @license OtabekNosirov
 * @license AkromovAzizjon
 */
global $boot;
$boot->start('homePage');
/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Главная страница';
$action->icon = 'fa fa-area-chart';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;

$action->cache = false;

$action->call = [];

$action->cacheHttp = false;

$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();




/*

vd($this->urlMain);
vd($this->urlParam);
vd($this->urlArray);
vd($this->urlModule);
vd($this->urlModuleStr);
vd($this->urlParamStr);

$this->urlRedirect([
    'index',
    'sort' => '-id'
]);
*/



/*$product = Az::$app->market->product->product($product_id, 2, true);*/

$productsByStatusSale = Az::$app->market->offer->productByStatus('discount', 12);
$productsByStatusPopular = Az::$app->market->offer->productByStatus('popular', 12);
$productsByStatusNew = Az::$app->market->offer->productByStatus('new', 12);


//vdd(Az::$app->language);

//shop/user/session-basket/main

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
        'https://images.pexels.com/photos/461198/pexels-photo-461198.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500',
        'https://previews.123rf.com/images/veneratio/veneratio1511/veneratio151100044/48203428-landscape-iamge-of-river-flowing-through-lush-green-forest-in-summer.jpg',
        'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcRVDh2D2fzRSBYnwaA-70G74wjOeeZWbRnEVBMxfu1jVqcP9fMv&usqp=CAU',
        'https://images.pexels.com/photos/1095550/pexels-photo-1095550.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500',
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

    <style>
        .trending-category ul {
            display: flex;
            position: relative;
            padding: 0;
        }
        .trending-category ul li {
            display: flex;
        }
        .trend {
            margin-right: -55px;
            transition: .5s ease-in-out;
            z-index: 1;
        }
        .trend:hover {
            transition: .4s ease;
            margin-right: 1px;
        }
        .trending-category ul li a{
            display: flex;
            flex-direction: column;
            color: #222;
            text-decoration: none;
        }
        .trending-category .trend-title{
            padding: 10px 0;
            overflow: hidden;
            width: 50%;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            transition: .2s ease-in-out;
        }
        .trend:hover .trend-title{
            width: 100%;
        }
        .trending-category ul li img {
            width: 150px;
            border-radius: 10px;
            height: 150px;
        }
        .advertisement {
            display: flex;
            align-items: center;
            justify-content: center;
            color: #333;
            height: 100%;
            position: relative;
            background: rgba(174, 174, 174, 0.12);
            padding: 1em;
            max-height: 540px;
        }
        .advertisement-title {
            font-size: 42px;
            text-align: center;
        }
        .advertisement-icons {
            position: absolute;
            bottom: 10px;
            cursor: pointer;
            transform: scale(1);
            transition: .2s ease-in-out;
        }
        .advertisement-icons a {
            color: #444;
            opacity: .9;
        }
        .advertisement-icons i {
            font-size: 28px;
            transition: .2s ease-in-out;
        }
        .advertisement-icons i:hover {
            color: #0a5fcf;
        }
        .advertisement-icons:active {
            transform: scale(1.1);
        }
    </style>    
    
</head>
<body class="<?= ZWidget::skin['white-skin'] ?> scrollbar scrollbar-sunny-morning" style="background: #fafafa; position: relative">

<?php

$this->beginBody();

require Root . '/webhtm/block/header/mainM.php';
require Root . '/webhtm/block/navbar/mainCommonFozil.php';
require Root . '/render/menus/ZSidebarWidget/ready/main.php';

?>

<div class="market-container" style="background: #fff">
    <div class="w-100 p-2 mt-2">
        <div class="row">
            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-12 d-none d-lg-block media-category">
                <?

                echo zetsoft\widgets\market\ZMenuWidget::widget([
                    'config' => [
                        'open' => true,
                        'mode' => 'shop',
                        'isAll' => true,
                    ],
                ]);
                ?>
            </div>
            <div class="col-xl-6 col-lg-7">
                <?php

                echo zetsoft\widgets\market\ZCategoryListWidget::widget([]);
                ?>

               <div class="row">

                <?php
                    echo ZMSwiperWidget::widget([
                        'data' =>
                        [
                            'https://brand.assets.adidas.com/image/upload/f_auto,q_auto,fl_lossy/enSG/Images/clothes_tablet_tcm207-344555.jpg',
                            'https://wi-images.condecdn.net/image/dY9OKLRLpXZ/crop/2040/f/wired-nike.jpg'
                        ],
                        
                    ])
                ?>

               </div>

               <div class="row" style="overflow: hidden">

                   <div class="trending-category">
                       <ul class="flex">
                           <li class="trend"><a href="#">   
                                   <span class="trend-title">Бытовая техника</span>
                                   <img src="https://i0.wp.com/womensovetfour.ru/wp-content/uploads/2020/05/315.jpg?fit=833%2C759&ssl=1" alt="photo">
                               </a></li>
                           <li class="trend"><a href="#">
                                   <span class="trend-title">Аксессуары</span>
                                   <img src="https://im0-tub-com.yandex.net/i?id=b011088efe0eef4a2c8e32602a0eb581&n=13" alt="photo">
                               </a></li>
                           <li class="trend"><a href="#">
                                   <span class="trend-title">Для мужчин и женщин</span>
                                   <img src="https://im0-tub-com.yandex.net/i?id=2a45578a9798459c43ea278132f26032&n=13" alt="photo">
                               </a></li>
                           <li class="trend"><a href="#">
                                   <span class="trend-title">Телефоны и гаджеты</span>
                                   <img src="https://im0-tub-com.yandex.net/i?id=28e2793e687b1559c467423cec7c1a07&n=13" alt="photo">
                               </a></li>
                           <li class="trend"><a href="#">
                                   <span class="trend-title">Товары для дома</span>
                                   <img src="https://im0-tub-com.yandex.net/i?id=0c6f88fc89ba619800c086a5619a66af&n=13" alt="photo">
                               </a></li>
                           <li class="trend"><a href="#">
                                   <span class="trend-title">Книги</span>
                                   <img src="https://im0-tub-com.yandex.net/i?id=e142f7c0a0da0cbd47e97b49b1d3b09d&n=13" alt="photo">
                               </a></li>
                           <li class="trend"><a href="#">
                                   <span class="trend-title">Другие категории</span>
                                   <img src="https://im0-tub-com.yandex.net/i?id=d40c1bb47e8a7d9879a1fba580a965f8&n=13" alt="photo">
                               </a></li>
                       </ul>
                   </div>

               </div>
            </div>
          <div class="col-xl-3 col-lg-7">
            <div class="advertisement">
              <div class="advertisement-title">
                Mесто для вашей рекламы!
              </div>
             <div class="advertisement-icons">
               <a href="" target="blank">
                 <i class="fab fa-telegram"></i>
               </a>
             </div>
            </div>
          </div>
        </div>

        <div class="col-md-12">

        </div>


    </div>

    <div class="container-fluid mt-n4 mb-5">
        <div class="row mt-4">
            <div class="col-12 mb-2" id="new">
                <h3 class="d-flex align-items-center">Новинки<span class="ml-2 badge badge-success shadow-none fe-05 pb-1">New</span></h3>
            </div>
            <div class="col-12 w-100 m-0 p-0">
                <div class="row w-100 m-0 p-0">
                    <?
                    if (empty($productsByStatusNew)) {

                        echo $this->require( '/webhtm/shop/user/main-common/empty/emptyBySatus.php');
                        
                    } else {

                        foreach ($productsByStatusNew as $product) {
                            echo $this->require( '/render/cards/ZVMarketWidget/ready/main_rowFozil.php', [
                                'item' => $product,
                                'id' => random_int(1, 1000000)
                            ]);
                        }
                    }
                    ?>
                </div>
            </div>
        </div>

        <div class="row mt-4">

            <div class="col-12 ml-2" id="popular">
                <h3><?= Az::l('Популярные') ?><span class="ml-4 badge badge-danger shadow-none fe-05"></span></h3>
            </div>
            <div class="col-12">
                <? /*
                echo $this->require( '/webhtm/shop/user/main-common/block/swiperNumberOne.php');
                */ ?>
                <div class="row">
                    <?
                    if (empty($productsByStatusPopular)) {
                        echo $this->require( '/webhtm/shop/user/main-common/empty/emptyBySatus.php');
                    } else {
                        foreach ($productsByStatusPopular as $product) {
                            echo $this->require( '/render/cards/ZVMarketWidget/ready/main_rowFozil.php', [
                                'item' => $product,
                                'id' => random_int(1, 1000000)
                            ]);
                        }
                    }
                    ?>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 mt-4" id="sale">
                <h3 class="d-flex align-items-center">Cкидки<span class="ml-2 badge badge-danger shadow-none pb-1 fe-05">Sale<i
                                class="fas fa-percent px-1 fe-08"></i></span></h3>
            </div>
            <div class="col-12">
                <div class="row">
                    <?
                    if (empty($productsByStatusSale)) {
                        echo $this->require( '/webhtm/shop/user/main-common/empty/emptyBySatus.php');
                    } else {
                        foreach ($productsByStatusSale as $product) {
                            echo $this->require( '/render/cards/ZVMarketWidget/ready/main_rowFozil.php', [
                                'item' => $product,
                                'id' => random_int(1, 1000000)
                            ]);
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
echo ZFooterAllWidgetOrg::widget();
echo ZJspanelWidget::widget([]);

?>
<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
