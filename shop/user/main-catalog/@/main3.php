<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\shop\ProductItem;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZInfinityScrollAjaxWidget;
use zetsoft\widgets\market\ZFooterAllWidget;
use zetsoft\widgets\navigat\ZBreadcrumbsWidget;
use zetsoft\widgets\notifier\ZJspanelWidget;
use zetsoft\widgets\themes\ZCardWidget;

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

/** @var ZView $this */
$market_id = $this->httpGet('id');
if (empty($market_id)) {
    echo $this->require( '/webhtm/shop/user/product-single/empty/empty.php');
    return null;
}
$products = Az::$app->market->product->allProducts(null, $market_id, 0, 10);
$companylist = Az::$app->market->product->allCompanies();
foreach ($companylist as $item) {
    if ($item->id === (int)$market_id) $company = $item;
}
//vdd($company);

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

    $this->head();

    ?>
</head>
<body class="<?= ZWidget::skin['white-skin'] ?>">
<?php

$this->beginBody();
require Root . '/webhtm/block/header/main.php';
require Root . '/webhtm/block/navbar/main.php';

?>

<div class="container mt-2">

    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between">
                <div><img width="60" height="60" src="<?=ZArrayHelper::getValue($company->photo, 0)?>" alt=""></div>
            </div>
        </div>

    </div>

</div>
<section class="bg-dark">
    <div class="container">
        <div class="row ">
            <div class="col-md-3">
                <a href="#" class="fp-20 text-center">home</a>
            </div>
            <div class="col-md-3">
                <a href="#products" class="fp-20 text-center">products</a>
            </div>
            <div class="col-md-3">
                <a href="#new" class="fp-20 text-center">new</a>
            </div>
            <div class="col-md-3">
                <a href="#sale" class="fp-20 text-center">sale</a>
            </div>
        </div>
    </div>
</section>
<div class="container">
    <div class="row">
        <div class="col-md-12 p-gfh">
            <?php
            echo $this->require( '/webhtm/shop/user/main-common/block/swiper.php');
            ?>
        </div>
        <?foreach ($products as $item) {
            echo $this->require( '/render/cards/ZVMarketWidget/ready/main_row.php', [
                'item' => $item
            ]);
        }?>
    </div>
</div>

<div class="row py-2 px-2">
                 


<?php
echo ZFooterAllWidget::widget();
echo ZJspanelWidget::widget([]);
?>
<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
