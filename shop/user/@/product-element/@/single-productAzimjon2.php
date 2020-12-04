<?php

use rmrevin\yii\fontawesome\FA;
use zetsoft\dbitem\shop\ProductItem;
use zetsoft\dbitem\shop\PropertyItem;
use zetsoft\dbitem\chat\ReviewItem;
use zetsoft\dbitem\data\ALLApp;
use zetsoft\dbitem\data\Config;
use zetsoft\dbitem\data\Form;
use zetsoft\dbitem\data\TabItem;
use zetsoft\service\forms\Active;
use zetsoft\service\forms\ZPjax;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\widgets\cards\ZMiniStoreWidget;
use zetsoft\widgets\former\ZAjaxWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\inputes\ZInputWidget;
use zetsoft\widgets\inputes\ZKStarRatingWidget;
use zetsoft\widgets\inputes\ZKTouchSpinWidget;
use zetsoft\widgets\inputes\ZMImageRadioCompanyWidget;
use zetsoft\widgets\inputes\ZMImageRadioGroupWidget;
use zetsoft\widgets\market\ZMenuWidget;
use zetsoft\widgets\market\ZMSwiperWidget;
use zetsoft\widgets\market\ZProductPropertyWidget;
use zetsoft\widgets\market\ZReviewWidget;
use zetsoft\widgets\market\ZZoomWpWidget;
use zetsoft\widgets\menus\ZSidebarWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\navigat\ZSlimScrollWidget;
use zetsoft\widgets\navigat\ZSmartTabAjaxWidgetAZ;
use zetsoft\widgets\themes\ZTabWidget;
use zetsoft\dbitem\core\WebItem;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\market\ZFooterAllWidget;
use PhpOffice\PhpSpreadsheet\Shared\OLE\PPS\Root;
use zetsoft\widgets\navigat\ZSmartTabWidget;

/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Главная страница';
$action->icon = 'fa fa-area-chart';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;

$action->cache = false;
$action->cacheHttp = false;

$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

$item = new ZProductItem();

$product_id = $this->httpGet('id');

$reviews = Az::$app->market->review->getReviewByProductId($product_id);
/** @var ZProductItem[] $product */
$product = Az::$app->market->product->product($product_id);

/** @var PropertyItem[] $productProperty */
$productProperty = Az::$app->market->product->product($product_id)->allProperties;



Az::$app->market->wish->writeViewed($product_id);

/** @var ZView $this */
$tabs = [];
$item = new TabItem();
$item->title = Azl . 'Описание';
$item->url = '/shop/user/product/tab_product.aspx?id=' . $product_id;
$item->class = 'p-1';
$item->pushUrl = true;
$tabs[] = $item;


$item = new TabItem();
$item->title = 'Характеристика';
$item->url = '/shop/user/product/clean1.aspx?id=' . $product_id;
$item->class = 'pt-3 ';
$tabs[] = $item;


$item = new TabItem();
$item->title = Azl . 'Цены';
$item->content = '';
$item->class = 'p-1';
$item->pushUrl = true;
$tabs[] = $item;


$item = new TabItem();
$item->title = 'Отзывы';
$item->content = $this->require( '/webhtm/shop/user/product/block/reviews.php', ['reviews' => $reviews]);
$item->class = 'pt-3';
$tabs[] = $item;


$item = new TabItem();
$item->title = 'Вопросы и Ответы';
$item->content = $this->require( '/render/market/Questions answers/clean.php');
$item->class = 'p-1';
$tabs[] = $item;

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
//require Root . '/render/menus/ZSidebarWidget/ready/main.php';

?>
<div class="mt-1">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card-title">
                    <h3><?= $product->name ?></h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 bg-white py-2">
                <?php
                echo $this->require( '/webhtm/block/SingleProduct/stars.php', ['product' => $product]);
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-xl-12">
                <?php
                echo ZSmartTabAjaxWidgetAZ::widget([
                    'data' => $tabs,
                    'config' => [
                        'product_id' => $product_id
                    ],
                ]);
                ?>
            </div>
        </div>
        <div class="row">
            <div class="market-list">

            </div>
        </div>
    </div>
</div>


<?php

?>
<div>
    <?=
    $this->require( '/webhtm/block/SingleProduct/footer.php');
    ?>
</div>

<!--<script>
    window.onload = () => {
        let temp = "<div class='text-danger text-center ' id='market-alert'>Для начала необходимо выбрать свойства продукта</div>";
        $('#market_list').append(temp);
        //loadData();
        console.log(temp);
    };

    /*let radioBtns = document.querySelectorAll('input[type="radio"]');
    radioBtns.forEach(item => {
        item.addEventListener('click', (event) => {
            loadData();
            var refreshMarketList = document.querySelector('#refreshMarketList');
            refreshMarketList.addEventListener('click');
        })
    });*/

    var radioBtns = $('input[type="radio"]');

    radioBtns.each(function (key, radio) {
        $(radio).click(function () {
            loadData();
            $('#refreshMarketList').click();
        })
    });

    function loadData() {
        $.ajax({
            url: '/core/product/getCompanyAZ.aspx',
            type: 'GET',
            data: $("#formModal").serialize(),
            success: function (data) {
                $('#market-alert').remove();
                $('.data').html(data);
                $('.market-company').removeClass('d-none');
                $('.data').addClass('d-none');
                setTimeout(function () {
                    $('.market-company').addClass('d-none');
                    $('.data').removeClass('d-none');
                }, 3000)
                $('.data').find('span').addClass('d-block')
            },
            error: function (e) {
                console.log(e);
            }

        });
    }


</script>-->

<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
