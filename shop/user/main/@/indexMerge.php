<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\shop\ShopBrand;
use zetsoft\models\shop\ShopCatalog;
use zetsoft\models\shop\ShopCategory;
use zetsoft\models\shop\ShopProduct;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZInfinityScrollAjaxWidget;
use zetsoft\widgets\market\ZFooterAllWidget;
use zetsoft\widgets\market\ZMSwiperWidget;
use zetsoft\widgets\notifier\ZJspanelWidget;

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
require Root . '/render/menus/ZSidebarWidget/ready/main.php';
require Root . '/webhtm/block/navbar/main.php';

?>

<div class="container-fluid mt-2">
    <div class="row">
        <div class="col-xl-3 col-lg-4 col-md-4 col-sm-4 media-category">
            <?

            /*echo $this->cacheRedis('menu', function () {
                return zetsoft\widgets\market\ZMenuWidget::widget([
                    'config' => [
                        'open' => true,
                        'mode' => 'shop'
                    ],
                ]);
            });*/

            echo $this->cacheRedis('menu',
                fn() => zetsoft\widgets\market\ZMenuWidget::widget([
                    'config' => [
                        
                        'open' => true,
                        'mode' => 'shop'
                    ],
                ]), [
                    ShopCategory::class,
                    ShopBrand::class
                ]);
            ?>
        </div>
        <div class="col-xl-9 col-lg-8">
            <div class="row">
                <div class="col-md-12 p-gfh">
                    <?php
                    echo ZMSwiperWidget::widget([
                        'data' => [
                            'https://gcdn.utkonos.ru/resample/940x300q95/images/banner/2020/05/19/46657_234607.png',
                            'https://gcdn.utkonos.ru/resample/940x300q95/images/banner/2020/04/22/46006_145036.jpg',
                            'https://gcdn.utkonos.ru/resample/940x300q95/images/banner/2020/05/19/46637_233144.jpg',
                            'https://gcdn.utkonos.ru/resample/940x300q95/images/banner/2020/05/19/46645_233631.jpg',
                            'https://gcdn.utkonos.ru/resample/940x300q95/images/banner/2020/05/07/44049_133221.jpg',
                        ],
                        'config' => [
                            'slidesPerView' => 1,
                            'height' => '50vh',
                            'class' => 'p-gfh',
                            'mousewheel' => false,
                            'slidesMediaPerView640' => 1,
                            'slidesMediaPerView500' => 1,
                            'slidesMediaPerView1024' => 1,
                            'slidesMediaPerView325' => 1,
                        ],
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12 p-0">
        <div class="row">


            <?

            //$items = Az::$app->market->product->allProducts(549);

            $slide_data = [];
            $categorys = Az::$app->market->category->generateDBMenuItems();
            $products_num = 0;
            foreach ($categorys as $category) {
                $products_num = count($category->items);
                $slide_data[] = $this->require( '/render/cards/ZMiniCardWidget/clean_mini_cards_container1.php', [
                    'categoryId' => $category->id,
                    'categoryName' => $category->label,
                    'categoryUrl' => $category->url,
                    'products_num' => $products_num,
                ]);

            }


            echo ZMSwiperWidget::widget([
                'data' => $slide_data,
                'config' => [
                    'slideWidget' => true,
                    'slidesPerView' => 3,
                    'pagination.el' => '',
                    'slidesMediaPerView640' => 2,
                    'slidesMediaPerView500' => 2,
                    'slidesMediaPerView1024' => 3,
                    'slidesMediaPerView325' => 1,
                    'nextEl' => '.swiper-button-next',
                    'prevEl' => '.swiper-button-prev',
                    'loop' => false,
                    'height_class' => 'py-2'
                ]
            ]);

            ?>

        </div>
        <div class="row">
            <div class="col-12 ml-2 ">

                <h3>Новинки<span class="ml-2 badge badge-success shadow-none fe-05">New</span></h3>
            </div>
            <div class="col-12">

                <?

                $items = Az::$app->market->productMerge->allProducts();
                $slide_data = [];
                $type = 'new';
                foreach ($items as $item) {
                    if (ZArrayHelper::isIn('new', $item->status)) {

                        $slide_data[] = $this->require( '/render/cards/ZMiniCardWidget/clean_3.php', [
                            'item' => $item,
                            'type' => $type
                        ]);
                    }

                }


                echo ZMSwiperWidget::widget([
                    'data' => $slide_data,
                    'config' => [
                        'slideWidget' => true,
                        'slidesPerView' => 2,
                        'pagination.el' => '',
                        'slidesMediaPerView640' => 5,
                        'slidesMediaPerView500' => 3,
                        'slidesMediaPerView1024' => 10,
                        'slidesMediaPerView325' => 2,
                        'nextEl' => '.swiper-button-next',
                        'prevEl' => '.swiper-button-prev',
                        'swip-nor' => 'p-2',
                        'height_class' => 'h-100',
                        'loop' => false,
                        'mousewheel' => false,
                    ]
                ]);

                ?>

            </div>

            <div class="col-12 ml-2 mt-4">
                <h3>Cкидки<span class="ml-2 badge badge-danger shadow-none fe-05"><i
                                class="fas fa-percent px-1 fe-07"></i></span></h3>
            </div>
            <div class="col-12">

                <?

                $items = $this->cacheRedis('products', function () {
                    return Az::$app->market->product->allProducts();
                });

                $slide_data = [];
                $type = 'sale';
                foreach ($items as $item) {
                    if (ZArrayHelper::isIn('sale', $item->status)) {
                        $slide_data[] = $this->require( '/render/cards/ZMiniCardWidget/clean_3.php', [
                            'item' => $item,
                            'type' => $type
                        ]);
                    }

                }

                echo ZMSwiperWidget::widget([
                    'data' => $slide_data,
                    'config' => [
                        'slideWidget' => true,
                        'slidesPerView' => 2,
                        'pagination.el' => '',
                        'slidesMediaPerView640' => 5,
                        'slidesMediaPerView500' => 3,
                        'slidesMediaPerView1024' => 10,
                        'slidesMediaPerView325' => 2,
                        'nextEl' => '.swiper-button-next',
                        'prevEl' => '.swiper-button-prev',
                        'swip-nor' => 'p-2',
                        'height_class' => 'h-100',
                        'loop' => false,
                        'mousewheel' => false,
                    ]
                ]);

                ?>
            </div>

        </div>
        <!--
                --><?php
        /*
                $this->pjaxBegin();

                echo ZInfinityScrollAjaxWidget::widget([
                    'config' => [
                        'url' => 'infinity.aspx',
                        'requireUrl' => '/render/cards/ZListViewWidget/demo/vertical.php',
                        'limit' => 4,
                        'namespace'=>'market',
                        'service'=>'product',
                        'method'=>'allProducts',
                        'args'=>null
                        //'cols' => 2
                    ]
                ]);

                $this->pjaxEnd();

                */ ?>
    </div>
    <div class="col-md-12 ">
        <h2 class="mt-4 mb-4  text-green-main text-center">Любимые бренды</h2>
        <?php


        echo ZMSwiperWidget::widget([
            'data' => [
                'https://bozorboy.com/pictures/brand/4589.png',
                'https://bozorboy.com/pictures/brand/4726.png',
                'https://bozorboy.com/pictures/brand/4868.png',
                'https://bozorboy.com/pictures/brand/4728.png',
                'https://bozorboy.com/pictures/brand/4831.png',
                'https://bozorboy.com/pictures/brand/4725.gif',
                'https://bozorboy.com/pictures/brand/4612.jpg',
                'https://bozorboy.com/pictures/brand/4746.png',
                'https://bozorboy.com/pictures/brand/4782.jpg',
                'https://bozorboy.com/pictures/brand/4832.jpg',
                'https://bozorboy.com/pictures/brand/4750.png',
            ],
            'config' => [
                'slidesPerView' => 5,
                'class' => 'brand',
                'height' => '170px',
                'width' => '150px',
                'mousewheel' => false,
                'pagination.el' => '',
                'slidesMediaPerView640' => 3,
                'slidesMediaPerView500' => 3,
                'slidesMediaPerView1024' => 5,
                'slidesMediaPerView325' => 2,
            ],
        ]);

        ?>
    </div>

</div>

<?php
echo ZFooterAllWidget::widget();
echo ZJspanelWidget::widget([]);
?>
<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
