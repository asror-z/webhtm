<?php

use PhpOffice\PhpSpreadsheet\Shared\OLE\PPS\Root;
use rmrevin\yii\fontawesome\FA;
use zetsoft\dbitem\shop\CompanyCardItem;
use zetsoft\dbitem\shop\ProductItem;
use zetsoft\dbitem\data\ALLApp;
use zetsoft\dbitem\data\Config;
use zetsoft\dbitem\data\Form;
use zetsoft\service\forms\Active;
use zetsoft\service\forms\ZPjax;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\cards\ZHMarketSuggestion;
use zetsoft\widgets\cards\ZMiniStoreWidget;
use zetsoft\widgets\former\ZAjaxWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\inputes\ZKTouchSpinWidget;
use zetsoft\widgets\inputes\ZMImageRadioCompanyWidget;
use zetsoft\widgets\inputes\ZMImageRadioGroupWidget;
use zetsoft\widgets\navigat\ZButtonWidget;


$get = $this->sessionGet('catalogForm');
$productId = ZArrayHelper::getValue($get, 'product_id');
unset($get['product_id']);
$product_id = $this->httpGet('id');
// $product = Az::$app->market->product->product($product_id);
//$set = Az::$app->market->product->catalogsByElement($productId, $get);


if (!isset($set)) {
    $set = [];

    $item = new CompanyCardItem();
    $item->name = 'test company';
    $item->title = 'test company title';
    $set[] = $item;
    $set[] = $item;
    $set[] = $item;
    $set[] = $item;
}


if (!isset($product)) {
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

   $items[] = $item;
}


?>


<div class="row py-4">
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
                            foreach ($productProperty as $key => $value): ?>

                                <li class="font-weight-light">
                                    <?= $value->name . ' - ';
                                    echo implode('', $value->items);
                                    ?>
                                </li>

                            <? endforeach; ?>
                        </ul>
                        <div class="mt-3">
                            <a href="#tab-2">Все характеристики</a>
                        </div>
                        <div class="mt-1">
                            <a href="#tab-5">Задать вопрос о товаре</a>
                        </div>
                        <div>
                            <a href="<?= $product->categoryUrl ?: '/shop/user/common-market/market.aspx' ?>"
                                data-pjax="0"
                            >Все товары <span
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
                  <!--  --><?/*

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
                    */?>

                    <?
                    $this->pjaxBegin();
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
                    /*echo $this->require( '/webhtm/shop/user/product/block/components/companyCard.php', [
                        'item' => $product
                    ]);*/
                    echo $this->require( '/render/cards/ZVSinglePopularDeal/ready/price_card.php');
                    $this->pjaxEnd();
                   /* $item = [];
                    if ($set) {

                        foreach ($set as $value) {
                            $item[$value->id] = $elem;
                        }

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

                    */?>

               <!--     --><?/* $this->pjaxEnd(); */?>

                </div>
                <div class="d-flex justify-content-center align-items-center ">
                    <?
                    echo $this->require( '/webhtm/block/SingleProduct/slim.php', ['product' => $product]);
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-5">

        <!--<div class="row">
            <div>Предложения магазинов</div>
            <div>Смотреть все цены</div>
        </div>-->
        <div class="row">
            <?
            echo ZHMarketSuggestion::widget([
                'config' => [
                    /*'items' => $items,*/
                    'stars-size' => '12px',
                ]
            ]);
            ?>
        </div>
    </div>
</div>


