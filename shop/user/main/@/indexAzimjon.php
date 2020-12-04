<?php

use yii\debug\Module;
use zetsoft\dbitem\core\WebItem;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZInfinityScrollAjaxWidget;
use zetsoft\widgets\market\ZFooterAllWidget;
use zetsoft\widgets\market\ZMSwiperWidget;
use zetsoft\widgets\navigat\ZShowMoreWidget;
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
require Root . '/webhtm/block/navbar/mainAzimjon.php';

?>

<div class="container-fluid mt-2" >
    <div class="row">
        <div class="col-xl-3 col-lg-4 col-md-4 col-sm-4 media-category">
            <?
            echo zetsoft\widgets\market\ZMenuWidget::widget([
                'config' => [
                    'open' => true,
                    'mode' => 'shop'
                ],
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

            <div class="col-12 pt-4">

                <?
                $items = Az::$app->market->product->getAllProductsByCompany(57, 550);
                    $slide_data = [];

                    foreach ($items as $item) {
                        $slide_data[] = $this->require( '/render/cards/ZMiniCardWidget/clean_3.php', [
                            'item' => $item
                        ]);
                    }

                    echo ZMSwiperWidget::widget([
                        'data' => $slide_data,
                        'config' => [
                            'slideWidget' => true,
                            'slidesPerView' => 2,
                            'pagination.el' => '',
                            'slidesMediaPerView640' => 5,
                            'slidesMediaPerView500' => 3,
                            'slidesMediaPerView1024' => 7,
                            'slidesMediaPerView325' => 2,
                            'nextEl' => '.swiper-button-next',
                            'prevEl' => '.swiper-button-prev',
                            'swip-nor' => 'p-2',
                            'height_class'=>'h-100',

                        ]
                    ]);
                 ?>

            </div>
            <
            <div class="col-12 pt-4">

                <?

                $items = Az::$app->market->product->allProducts();
                $slide_data = [];
                $sale='sale';
                foreach ($items as $item) {

                    $slide_data[] = $this->require( '/render/cards/ZMiniCardWidget/clean_3.php', [
                        'item' => $item,
                        'sale'=> $sale
                    ]);

                }


                echo ZMSwiperWidget::widget([
                    'data' => $slide_data,
                    'config' => [
                        'slideWidget' => true,
                        'slidesPerView' => 2,
                        'pagination.el' => '',
                        'slidesMediaPerView640' => 5,
                        'slidesMediaPerView500' => 3,
                        'slidesMediaPerView1024' => 7,
                        'slidesMediaPerView325' => 2,
                        'nextEl' => '.swiper-button-next',
                        'prevEl' => '.swiper-button-prev',
                        'swip-nor' => 'p-2',
                        'height_class'=>'h-100',

                    ]
                ]);

                 ?>

            </div>
        </div>

        <?php

        $this->pjaxBegin();

        echo ZInfinityScrollAjaxWidget::widget([
            'config' => [
                'url' => '/blocks/infinite/infinite.aspx',
                'requireUrl' => '/render/cards/ZListViewWidget/demo/vertical.php',
                'limit' => 4,
                'cols' => 2
            ]
        ]);

        $this->pjaxEnd();

        ?>
    </div>
    <div class="col-md-12 ">
        <h2 class="mt-4 mb-4  text-green-main text-center">Любимые бренды</h2>
        <?php echo ZMSwiperWidget::widget([
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
//echo ZJspanelWidget::widget();
?>
<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
