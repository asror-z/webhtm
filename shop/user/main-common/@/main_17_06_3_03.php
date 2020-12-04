 <?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\market\ZFooterAllWidget;
use zetsoft\widgets\navigat\ZBreadcrumbsWidget;
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
require Root . '/webhtm/block/navbar/main.php';
require Root . '/render/menus/ZSidebarWidget/ready/main.php';

?>

<div class="container-fluid mt-2">
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
            <?php
            $category_id = $this->httpGet('id');
            if (isset($category_id))
                echo ZBreadcrumbsWidget::widget([
                    'config' => [
                        'mainUrl' => '/shop/user/filter-common/main',
                        'mode' => ZBreadcrumbsWidget::mode['category'],
                        'category_id' => $category_id,
                    ]
                ]);
            ?>
            <div class="row">
                <div class="col-md-12 p-gfh">
                    <?php
                    echo $this->require( '/webhtm/shop/user/main-common/block/swiper.php');
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12 p-0">
        <div class="row">


            <?
            echo $this->require( '/webhtm/shop/user/main-common/block/swiperNumberOne.php');
            ?>

        </div>
        <div class="row">
            <div class="col-12 ml-2 ">
                <h3>Новинки<span class="ml-2 badge badge-success shadow-none fe-05">New</span></h3>
            </div>
            <div class="col-12">

                <?
                
                require __DIR__ . '/block/swiperNumberFour.php';

                ?>

            </div>

            <div class="col-12 ml-2 mt-4">
                <h3>Cкидки<span class="ml-2 badge badge-danger shadow-none fe-05"><i
                                class="fas fa-percent px-1 fe-07"></i></span></h3>
            </div>
            <div class="col-12">

                <?

                echo $this->require( '/webhtm/shop/user/main-common/block/swiperNumberThree.php');
                     
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
        <!--<h2 class="mt-4 mb-4  text-green-main text-center">Любимые бренды</h2>
        --><? /*
         echo $this->require( '/webhtm/shop/user/main/block/swiperNumberFour.php');

        */ ?>
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
