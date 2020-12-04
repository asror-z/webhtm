<?php

use rmrevin\yii\fontawesome\FA;
use zetsoft\dbitem\shop\PropertyItem;
use zetsoft\dbitem\shop\ProductItem;
use zetsoft\dbitem\data\ALLApp;
use zetsoft\dbitem\data\Config;
use zetsoft\dbitem\data\Form;
use zetsoft\dbitem\data\TabItem;
use zetsoft\dbitem\shop\SingleProductItem;
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
$action->type = WebItem::type['ajax'];
$action->csrf = true;
$action->debug = true;

$action->cache = false;
$action->cacheHttp = false;

$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

$item = new ProductItem();

$product_id = $this->httpGet('id');

$reviews = Az::$app->market->review->getReviewByProductId($product_id);



/** @var ProductItem[] $product */
//$product = Az::$app->market->product->product($product_id);


$product = new SingleProductItem();

$product->id = 18;
$product->catalogId = 19;
$product->name = 'Product Name';
$product->amount = 0;
$product->status = ['new', 'sale'];
$product->categoryId = 18;
$product->categoryName = 'catalogName';
$product->categoryUrl = '';
$product->title = '';
$product->currency = '$';
$product->currencyType = 'before';
$product->text = '';
$product->brand = '';
$product->brandImage = '';
$product->rating = (string)3.0;
$product->reviewCount = 8;
$product->url = '';
$product->visible = true;
$product->image = [];
$product->is_multi = '';
$product->in_wish = '';
$product->in_compare = '';
$product->cart_amount = '';
$product->items = [];
$product->barcode = '';
$product->new_price = 120;
$product->price_old = 120;

/** @var PropertyItem[] $productProperty */
//$productProperty = Az::$app->market->product->product($product_id)->allProperties;

$productProperty = new PropertyItem();
$productProperty->name = '182sad';
$productProperty->branch = '00421sa';
$productProperty->items = [
    'huihuih',
    'okjio',
    'juijiio'
];


$properties[]=$productProperty;
$properties[]=$productProperty;
$properties[]=$productProperty;
$properties[]=$productProperty;
Az::$app->market->wish->writeViewed($product_id);


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

?>
<div class="row py-5">
    <div class="col-lg-6 col-md-12 col-sm-12">
        <div class="row ">
            <div class="col-md-6 col-xl-6 col-sm-12 col-12 ">
                <div class="d-flex justify-content-center">
                    <? /*= $this->require('/blocks/SingleProduct/imageZoom.php', ['product'=>$product]) */ ?>
                    <?= $this->require( '/render/cards/ZZoomWidget/ready/zoom.php') ?>
                </div>
            </div>
            <div class="col-md-6 col-xl-6 col-sm-12 col-12">
                <div class="row px-3">
                    <div class="col-md-12">
                        <h3><?= Az::l('Свойства продукта') ?></h3>
                    </div>
                    <div class="col-md-12">

                        <?
                        echo $this->require( '/webhtm/block/SingleProduct/properties.php', ['product' => $product]);
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6 col-md-12 col-sm-12">
        <div class="row mb-2">
            <div class="col-md-6 col-xl-6 col-sm-12 ">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="text-left font-weight-normal"><?php echo Az::l('Коротко о товаре'); ?></h3>
                        <ul class="pl-4 mb-0 fe-08">
                            <?
                            $count = 0;
                            //foreach (array_slice($productProperty, 0, 5) as $key => $value) {
                            foreach ($properties as $key => $value) {
                                ?>
                                <li class="font-weight-light"><?= $value->name . ' - ';
                                    foreach ($value->items as $_key => $_value) {
                                        $count++;
                                        if ($count === 1) {
                                            echo $_value;
                                        }
                                    }
                                    $count = 0 ?></li>
                            <? } ?>
                        </ul>
                        <div class="mt-3">
                            <a href="#tab-2">Все характеристики</a>
                        </div>
                        <div class="mt-1">
                            <a href="#tab-5">Задать вопрос о товаре</a>
                        </div>
                        <div>
                            <a href="<? $product->categoryUrl ?>">Все товары <span
                                        class="font-weight-bold"><?= $product->brand ?></span> </a>
                        </div>
                        <a href="<?= $product->categoryUrl ?>">
                            <div style='height: 50px; background-image: url("<?= $product->brandImage ?>"); background-size: contain; background-repeat: no-repeat'
                                 class="brand-image"></div>
                        </a>
                    </div>


                </div>

            </div>
            <div class="col-md-6 col-xl-6 col-sm-12 px-2">
                <div class="d-flex justify-content-center flex-column">
                    <h1 class="bold fp-30 text-center"> <?= Azl . 'Цены в магазинах' ?></h1>
                </div>
                <div class="d-flex justify-content-center flex-column" id="market_list">

                    <?
                    /** @var ZView $this */
                    $pjax = new ZPjax();
                    $pjax->class = 'd-flex';
                    $this->pjaxBegin($pjax);

                    echo ZButtonWidget::widget([
                        'config' => [
                            'url' => '',
                            'hasIcon' => true,
                            'btnType' => ZButtonWidget::btnType['link'],
                            'btnStyle' => ZButtonWidget::btnStyle['none'],
                            'btnRounded' => false,
                            'text' => 'hiddne',
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
                    ?>

                    <?
                    $get = $this->sessionGet('catalogForm');
                    $productId = ZArrayHelper::getValue($get, 'product_id');
                    unset($get['product_id']);


                    $set = Az::$app->market->product->catalogsByElement($productId, $get);

                    //$elem = $this->require( '/render/cards/ZVMarketWidget/ready/main.php',['item' => $product]);

                    $item = [];

                    if ($set) {

                        /*foreach ($set as $value) {
                            $item[$value->id] = $elem;
                        }*/

                        $app = new ALLApp();
                        $config = new Config();
                        $config->title = 'sell';

                        $active = new Active();
                        $active->id = 'compForm';

                        $form = $this->activeBegin($active);

                        $column = new Form();
                        $column->title = 'category';
                        $column->widget = ZMImageRadioCompanyWidget::class;
                        $column->options = [
                            'config' => [
                                'url' => ZMImageRadioGroupWidget::imageUrl['none'],
                            ],
                            'event' => [
                                'onclick' => '
                                    function () {
                                        $(".bootstrap-touchspin").removeClass("d-none");
                                        $(".hiddenButton").removeClass("d-none");
                                        $(".imgCheckbox2 ").css("border","none");
                                    }
                                '
                            ]
                        ];

                        $column->data = $item;

                        $app->columns['catalog'] = $column;

                        $column = new Form();
                        $column->title = Az::l("Количество");
                        $column->widget = ZKTouchSpinWidget::class;
                        $column->options = [
                            'config' => [
                                'min' => '0',
                                'max' => '10000',
                                'step' => '1',
                                'buttonup_txt' => '<i class="fa fa-plus"></i>',
                                'buttondown_txt' => '<i class="fa fa-minus text-danger"></i>',
                                'buttonup_class' => 'btn btn-outline-success',
                                'buttondown_class' => 'btn btn-outline-danger',
                                'class' => 'text-center'
                            ],
                            'event' => [
                                'startupspin' => <<<JS
                function () {
                    var amount = $(this).val();
                    $.ajax({
                        url: '/shop/core/product/setToCart.aspx',
                        data: {
                            catalog_id: $productId,
                            amount: amount,
                        },
                        success: function(data) {
                            $('#cart_total_amount').html(data);
                            $('#refreshMarketList').click();
                        }
                   })
                }
JS,
                                'startdownspin' => <<<JS
                    function () {
                        var amount = $(this).val();
                        $.ajax({
                            url: '/shop/core/product/setToCart.aspx',
                            data: {
                                catalog_id: $productId,
                                amount: amount!==1 ? amount-- : amount,
                            },
                            success: function(data) {
                                $('#cart_total_amount').html(data);
                                $('#refreshMarketList').click();
                            }
                        })
                    }
            
JS,
                                'starthistoryspin' => <<<JS
        function () {
              var amount = $(this).val();
              
                   $.ajax({
                      url: '/shop/user/viewed/index.aspx',
                      data: {
                            catalog_id: $productId,
                            amount: amount!==1 ? amount-- : amount,
                      },
                      success: function(data) {
                        $('#cart_total_amount').html(data);
                      }
                      
                   })
                }
            
JS,


                            ]
                        ];

                        $app->columns['amount'] = $column;

                        $app->cards = [];

                        $model = Az::$app->forms->former->model($app);

                        echo ZFormWidget::widget([
                            'model' => $model,
                            'form' => $form,
                            'config' => [
                                'topBtn' => false,
                                'botBtn' => false,
                            ]

                        ]);

                        echo ZButtonWidget::widget([
                            'config' => [
                                'class' => 'd-none btn-block hiddenButton',
                                'text' => Az::l('Добавить в корзину'),
                                'btnStyle' => ZColor::btnStyle['btn-outline-success'],
                                'btnRounded' => false,
                                'btnType' => ZButtonWidget::btnType['button'],
                                'type' => ZAjaxWidget::type['get'],
                                'ajax' => true,
                                'url' => ZUrl::to(['/core/product/setToCart']),
                                'dataType' => 'html',
                                'data' => "$('#compForm').serialize()",
                                'icon' => 'mr-1 fa fa-' . FA::_SHOPPING_CART,
                                'hasIcon' => true
                            ],
                            'event' => [
                                'success' => 'function (data) {
                    //$(\'#cart_total_amount\').html(data);
                    $("#refreshMessage").click();
                }'
                            ]
                        ]);


                        $this->activeEnd();
                        echo "<script>
    $(document).ready(function () {
        $('.bootstrap-touchspin').addClass('d-none');
    });
</script>";
                    } else {
                        echo "<div class='w-100 h-25'><img class='w-75 h-50 ml-5' src='https://cdn.dribbble.com/users/357797/screenshots/3998541/empty_box.jpg'></div>";
                    }

                    ?>

                    <? $this->pjaxEnd(); ?>

                </div>
                <div class="d-flex justify-content-center align-items-center ">
                    <?
                    echo $this->require( '/webhtm/block/SingleProduct/slim.php', ['product' => $product]);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>


<?php $this->endBody() ?>

<script>
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
            //$('#refreshMarketList').click();
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

                $('#refreshMarketList').click();
            },
            error: function (e) {
                console.log(e);
            }

        });
    }


</script>

</body>
</html>

<?php $this->endPage() ?>
