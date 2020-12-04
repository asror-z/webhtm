<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\shop\ProductItem;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZInfinityScrollAjaxWidget;
use zetsoft\widgets\blocks\ZJqueryKnobWidget;
use zetsoft\widgets\market\ZFooterAllWidget;
use zetsoft\widgets\navigat\ZBreadcrumbsWidget;
use zetsoft\widgets\notifier\ZJspanelWidget;

/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Страница Компании';
$action->icon = 'fa fa-area-chart';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;

$action->cache = false;

$action->call = [];

$action->cacheHttp = false;

$this->paramSet(paramAction, $action);


/*$product = Az::$app->market->product->product($product_id, 2, true);*/
$productsByStatusSale = Az::$app->market->product->productByStatus(null, 'sale', 12, null);
$productsByStatusNew = Az::$app->market->product->productByStatus(null, 'new', 12, null);
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

/** @var ZView $this */
$market_id = $this->httpGet('id');
if(!isset($market_id)){
    echo "Вы не выбрали компанию";
    return "df";
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
require Root . '/render/menus/ZSidebarWidget/ready/main.php';

?>

<div class="container-fluid mt-2">
    <div class="row">
        <div class="col-xl-3 col-lg-4 col-md-4 col-sm-4 media-category">
            <?


            echo zetsoft\widgets\market\ZMenuWidget::widget([
                'config' => [
                    'open' => true,
                    'mode' => 'shop',
                    'company_id' => $market_id

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
                        'mainUrl' => 'user/main-market',
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
</div>

<div class="container-fluid mt-2 mb-5">
    <div class="row mt-4">
        <div class="col-md-12">
            <?

            echo $this->require('/render/cards/NewsCard/brand-block.php');
            ?>

        </div>
        <div class="col-md-12">

            <?
            echo $this->require( '/webhtm/shop/user/main-common/block/swiperNumberOne.php');


            ?>

        </div>
    </div>


    <div class="row mt-4">
        <div class="col-12 ml-2 ">
            <h3><?= Az::l('Новинки') ?><span class="ml-2 badge badge-success shadow-none fe-05">New</span></h3>
        </div>
        <div class="col-12">
            <div class="row">
                <?
                foreach ($productsByStatusNew as $product)

                    echo $this->require( '/render/cards/ZVMarketWidget/ready/main_row2.php', [
                        'item' => $product,
                        'isCommon' => false
                    ]);
                ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 mt-4">
            <h3><?= Az::l('Cкидки') ?><span class="ml-4 badge badge-danger shadow-none fe-05"><i
                            class="fas fa-percent px-1 fe-07"></i></span></h3>
        </div>
        <div class="col-12">

            <div class="row">
                <?
                foreach ($productsByStatusSale as $product)

                    echo $this->require( '/render/cards/ZVMarketWidget/ready/main_row2.php', [
                        'item' => $product,
                        'isCommon' => false
                    ]);
                ?>
            </div>
        </div>
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
