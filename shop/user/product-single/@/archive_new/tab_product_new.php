<?php

use PhpOffice\PhpSpreadsheet\Shared\OLE\PPS\Root;
use rmrevin\yii\fontawesome\FA;
use zetsoft\dbitem\shop\CompanyCardItem;
use zetsoft\dbitem\shop\ProductItem;
use zetsoft\dbitem\data\ALLApp;
use zetsoft\dbitem\data\Config;
use zetsoft\dbitem\data\Form;
use zetsoft\former\shop\ShopCompanyCardForm;
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
use zetsoft\widgets\incores\ZMCheckboxGroupWidgetAz;
use zetsoft\widgets\inputes\ZInputWidget;
use zetsoft\widgets\inputes\ZKTouchSpinWidget;
use zetsoft\widgets\inputes\ZMImageRadioCompanyWidget;
use zetsoft\widgets\inputes\ZMImageRadioGroupWidget;
use zetsoft\widgets\market\ZZoomWpWidget;
use zetsoft\widgets\navigat\ZButtonWidget;

/** @var ZView $this */


$product_id = $this->httpGet('id');
//vd($get);
$product = Az::$app->market->product->product($product_id, 2, true);

//vd($productId);
//$get = [];

//vd($set);

if (!isset($product) || $product===null) {

    $product = new ProductItem();
    $product->id = 2;
    $product->name = 'Арахисовая паста с медом 200г';
    $product->title = 'Test Desc';
    $product->new_price = '14825920';
    $product->price_old = '188920';
    $product->barcode = '34234234';
    $product->exist = ProductItem::exists['not'];
    $product->images = [
        'https://images.pexels.com/photos/1095550/pexels-photo-1095550.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500',
        'https://images.pexels.com/photos/461198/pexels-photo-461198.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500',
        'https://previews.123rf.com/images/veneratio/veneratio1511/veneratio151100044/48203428-landscape-iamge-of-river-flowing-through-lush-green-forest-in-summer.jpg',
        'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcRVDh2D2fzRSBYnwaA-70G74wjOeeZWbRnEVBMxfu1jVqcP9fMv&usqp=CAU',
    ];
    $product->currency = 'сум';
    $product->currencyType = 'after';
    $product->measure = 'шт';
    $product->rating = 3.5;
    $product->discount = -10;
    $product->catalogId = 19;
    $product->max_price = 2155632;
    $product->sale = 'sdadsa';
    $product->is_multi = false;
    $product->min_price = 'adssad';
    $product->in_wish = true;
    $product->in_compare = false;

}




?>


<div class="row py-4">
    <div class="col-lg-5 col-md-12 col-sm-12">
        <div class="row ">
            <div class="col-md-7 col-xl-8 col-sm-12 col-12 ">
                <div class="d-flex justify-content-center">
                    <? /*= $this->require('/blocks/SingleProduct/imageZoom.php', ['product'=>$product]) */ ?>
                    <?php
                    /*echo ZZoomWpWidget::widget([
                        'data' => $product->images
                    ]);*/
                    ?>
                    <?= $this->require( '/render/cards/ZZoomWidget/ready/zoom.php', [
                        'product' => $product
                    ]) ?>
                </div>
            </div>
            <div class="col-md-5 col-xl-4 col-sm-12 col-12">
                <div class="row px-3">
                    <div class="col-md-12">
                        <h5 class=""><?= Az::l('Свойства продукта') ?></h5>
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

    <div class="col-lg-7 col-md-12 col-sm-12">
        <div class="row mb-2">
            <div class="col-md-6 col-xl-5 col-sm-12 ">
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="text-left"><?php echo Az::l('Коротко о товаре'); ?></h5>
                        <ul class="pl-4 mb-0">
                            <?
                            $count = 0;
                            foreach ($product->properties as $key => $value):

                                ?>

                                <li class="font-weight-normal text-muted fp-16">
                                    <?= $value->name . ' - ';
                                    echo implode(', ', $value->items);
                                    ?>
                                </li>

                            <? endforeach; ?>
                        </ul>

                        <!-- <div class="mt-3">
                            <a href="#tab-2">Показать больше...</a>
                        </div>
                        <div class="mt-1">
                            <a href="#tab-5">Задать вопрос о товаре</a>
                        </div>
                        <div>
                            <a href="<? /*= $product->categoryUrl ?: '/shop/user/common-market/market.aspx' */ ?>"
                               data-pjax="0"
                            >Все товары <span
                                        class="font-weight-bold"><? /*= $product->brand */ ?></span> </a>
                        </div>-->

                        <a href="<?= $product->categoryUrl ?>">
                            <div style='height: 50px; background-image: url("<?= $product->brandImage ?>"); background-size: contain; background-repeat: no-repeat'
                                 class="brand-image"></div>
                        </a>
                    </div>


                </div>

            </div>
            <div class="col-md-6 col-xl-7 col-sm-12 px-2">
                <div class="d-flex justify-content-center flex-column">
                    <h5 class="bold text-center"> <?= Azl . 'Популярные предложения из магазинов' ?></h5>
                </div>
                <div class="d-flex justify-content-center flex-column" id="market_list">


                    <?
                    $this->pjaxBegin();
                 


                    $get = $this->sessionGet('catalogForm');

                    $productId = ZArrayHelper::getValue($get, 'product_id');
                 unset($get['product_id']);
                    $set = Az::$app->market->cart->getcatalogsByElement($productId, $get);
                     
                    if (!isset($set) || empty($set)) {
                        $set = [];

                        $item = new ShopCompanyCardForm();
                        $item->name = 'Korzinka';
                        $item->title = 'Korzinka';
                        $item->new_price = '15.555';
                        $item->price_old= '17.555';
                        $item->image='https://png2.cleanpng.com/sh/75903e9dcfe3b12778615625e127aa30/L0KzQYi4UsE4N5UAfZGAYUO5RLO7VPVmPWpoS5C5MUSzRYi8V8E2OWQ6SKkBNUK8R4e6TwBvbz==/5a364b44ee59c3.0140575715135076529763.png';
                        $set[] = $item;
                        $item = new ShopCompanyCardForm();
                        $item->name = 'Redtag';
                        $item->title = 'Redtag';
                        $item->image= 'https://png2.cleanpng.com/sh/98851300f08aaa0951ece0d7f53bf371/L0KzQYm3V8I5N5h4jZH0aYP2gLBuTfdwd5hxfZ91b3fyPbP8kBlvbaR4Rd9yY4Lyg7FtlL14cZ9phAl8LXBzdcPolPlvb154keV9ZX2wRbO8gBI6QZZpetNvZkKxQIG6VsczQWk2TaU7OEC2RIm9WMk6QV91htk=/kisspng-google-logo-business-microsoft-windows-operating-system-5b5cb99edbaff2.0036729815328034868999.png';
                        $item->new_price = '10.555';
                        $item->price_old = '14.555';

                        $set[] = $item;

                    }

                    foreach ($set as $magazin){
                        //$i++;
                        //if($i>3)continue;
                        echo $this->require( '/render/cards/ZCompanyCardWidget/ready/main.php', [
                            'item' => $magazin
                        ]);
                    }

                    $this->pjaxEnd();
                     ?>

                    

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
<div class="col-12">
    <div class="">
        <div class="fp-28 border-bottom font-weight-normal">С этим товаром смотрят</div>
    </div>
    <div>
        <?

        echo $this->require( '/render/cards/ZProductsAlsoWidget/pages/sample.php');
        ?>
    </div>

</div>

</div>
</div>


