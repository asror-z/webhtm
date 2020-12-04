<?php

use zetsoft\dbitem\shop\ProductItem;
use zetsoft\dbitem\chat\ReviewItem;
use zetsoft\dbitem\data\ALLApp;
use zetsoft\dbitem\data\Form;
use zetsoft\dbitem\data\TabItem;
use zetsoft\service\forms\Active;
use zetsoft\service\forms\ZPjax;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
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

$item = new ZProductItem();

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

$product_id = $this->httpGet('id');

$reviews = Az::$app->market->review->getReviewByProductId($product_id);
$reviewItem = '';
foreach ($reviews as $review) {
    $reviewItem = $review;
}


/** @var ZProductItem[] $product */
$product = Az::$app->market->product->product($product_id);
//vdd($product );
Az::$app->market->wish->writeViewed($product_id);

?>
<?php


use PhpOffice\PhpSpreadsheet\Shared\OLE\PPS\Root;
//use zetsoft\dbitem\data\TabItem;
//use zetsoft\system\kernels\ZView;
//use zetsoft\widgets\market\ZProductPropertyWidget;
//use zetsoft\widgets\market\ZReviewWidget;
use zetsoft\widgets\navigat\ZSmartTabWidget;
//use zetsoft\widgets\themes\ZTabWidget;

/** @var ZView $this */
$tabs = [];
$item = new TabItem();
$item->title = 'Информация';
$item->content = $this->require('/blocks/SingleProduct/imageZoom.php');
$item->class = 'p-1';
$item->pushUrl = true;
$tabs[] = $item;
$item = new TabItem();
$item->title = 'Характеристика';
$item->content = $this->require( '/render/bozor/ZCProductFeatureWidget/clean1.php', ['item' => $product]);
$item->class = 'pt-3 ';
$tabs[] = $item;
$item = new TabItem();
$item->title = 'Отзывы';
$item->content =

    ZReviewWidget::widget([
        'config' => [
            'data' => $reviews
        ]
    ]);

$item->class = 'pt-3';
$tabs[] = $item;
$item = new TabItem();
$item->title = 'Вопросы и Ответы';
$item->content = $this->require( '/render/market/Questions answers/clean.php');
$item->class = 'p-1';
$tabs[] = $item;


echo ZSmartTabWidget::widget([
    'data' => $tabs,
    'config' => [
        'type' => ZSmartTabWidget::theme['Classic'],
        //'tab-margin'=>'mx-1'
    ],
]);



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
                $('#market-alert').remove();
                $('.data').html(data);
                $('.market-company').removeClass('d-none');
                $('.data').addClass('d-none');
                setTimeout(function () {
                    $('.market-company').addClass('d-none');
                    $('.data').removeClass('d-none');
                }, 3000)

                console.log(data);
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
