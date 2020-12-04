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
use zetsoft\widgets\navigat\ZYandexTabWidget;
use zetsoft\widgets\themes\ZTabWidget;
use zetsoft\dbitem\core\WebItem;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\market\ZFooterAllWidget;
use PhpOffice\PhpSpreadsheet\Shared\OLE\PPS\Root;
use zetsoft\widgets\navigat\ZSmartTabWidget;

/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Продукт';
$action->icon = 'fa fa-area-chart';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;

$action->cache = false;
$action->cacheHttp = false;

$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

$product_id = $this->httpGet('id');
$reviews = Az::$app->market->review->getReviewByProductId($product_id);

/** @var ZProductItem[] $product */
$product = Az::$app->market->product->product($product_id);
/** @var PropertyItem[] $productProperty */
$productProperty = Az::$app->market->product->product($product_id)->allProperties;
Az::$app->market->wish->writeViewed($product_id);

$tabDatas = [
    Az::l('Описание') => '/shop/user/product/single-productAbdulloh.aspx?id=' . $product_id,
    Az::l('Характеристика') => '/shop/user/product/single_product_characteristics.aspx?id=' . $product_id,
    Az::l('Цены') => '',
    Az::l('Отзывы') => '/shop/user/product/single_product_shahzod.aspx?id=' . $product_id,
    Az::l('Вопросы и ответы') => '/shop/user/product/single_product_questions_answers.aspx?id=' . $product_id,
    Az::l('Карта') => '/shop/user/product/single-product-map.aspx'
];

$tabItems = [];
$tabItem = new TabItem();
foreach ($tabDatas as $label => $url) {
    $tabItem->url = $url;
    $tabItem->title = $label;

    $tabItems[] = $tabItem;
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

<?
$this->beginBody();


require Root . '/webhtm/block/header/main.php';
require Root . '/webhtm/block/navbar/main.php';
//require Root . '/render/menus/ZSidebarWidget/ready/main.php';

?>
<div>
    <?
    echo ZYandexTabWidget::widget([
        'data' => $tabItems
    ]);
    ?>
</div>
<div class="mt-1">
    <div class="market-container">
        <div class="row">
            <div class="col-md-12">
                <div class="card-title">
                    <? $this->pjaxBegin(); ?>
                    <h3><?= $product->name ?></h3>
                    <?
                    require Root . '/webhtm/shop/user/product/block/tab_product.php';
                    ['product' => $product, 'productProperty' => $productProperty];

                    echo ZButtonWidget::widget([
                        'config' => [
                            'url' => '',
                            'hasIcon' => true,
                            'btnType' => ZButtonWidget::btnType['link'],
                            'btnStyle' => ZButtonWidget::btnStyle['none'],
                            'btnRounded' => false,
                            'text' => 'hidden',
                            'pjax' => true,
                            'hidden' => true,
                            'title' => 'Обновление',
                            'ttSize' => ZButtonWidget::ttSize['small'],
                            'ttSide' => ZButtonWidget::ttSide['bottom'],
                            'btn' => false,
                            'class' => 'h-100 p-0 noHover',
                            'iconColor' => 'white',
                            'icon' => 'fp-13 fa fa-' . FA::_SYNC,
                        ],
                        'id' => 'refreshMarketList',
                    ]);

                    $this->pjaxEnd();
                    ?>

                </div>
            </div>b
        </div>
        <div class="row">
            <div class="col-md-12 bg-white py-2">
                <?php
                echo $this->require( '/webhtm/block/SingleProduct/stars.php', ['product' => $product]);
                ?>
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

<script>
    window.onload = () => {
        let temp = "<div class='text-danger text-center ' id='market-alert'>Для начала необходимо выбрать свойства продукта</div>";
        $('#market_list').append(temp);
        //loadData();
        console.log(temp);
    };
    $('.w17').addClass('active');

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
                $('.data').find('span').addClass('d-block');
                $('#market_list').css({"opacity": "0.5","z-index": "-1"});
                $('.market-company').parent().appendTo("#market_list");
                $('.market-company').removeClass("d-none");
                $('.market-company').parent().css({"z-index": "1"});
            },
            error: function (e) {
                console.log(e);
            }

        });
    }


</script>
<script>

</script>

<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
