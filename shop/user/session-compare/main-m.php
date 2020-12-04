<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\shop\ProductItem;
use zetsoft\system\assets\ZColor;use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\inputes\ZSelect2Widget;
use zetsoft\widgets\market\ZCompareJobirWidget;
use zetsoft\widgets\market\ZFooterAllWidget;
use zetsoft\widgets\market\ZMegaMenuWidget;
use zetsoft\widgets\market\ZMenuWidget;
use zetsoft\widgets\menus\ZSidebarWidget;
use zetsoft\widgets\navigat\ZButtonWidget;



/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . Az::l('Сравнить');
$action->icon = 'fa fa-area-chart';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;



/* $products = Az::$app->market->product->getCompareProductItems();*/
$products = null;
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
    $item->properties = [
        (object)[
            'name' =>'182sad',
            'branch' => '00421sa',
            'property'=> [
                'huihuih',
                'okjio',
                'juijiio'
            ],
        ],
    ];
    $item->allProperties=[
        (object)[
            'name' =>'182sad',
            'branch' => '00421sa',
            'property'=> [
                'huihuih',
                'okjio',
                'juijiio'
            ],
        ]
    ];
    $products[] = $item;
}

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
require Root . '/webhtm/block/navbar/main-m.php';

?>
<div class="container-fluid">
    <div class="row">

        <div class="col-xl-3 col-lg-4 mt-3">
            <div class="row">
                <div class="col-12">
                    <?
                        echo ZMenuWidget::widget([
                            'config' => [
                                'open' => true,
                                //'name' => 'Категории',
                                'mode' => 'shop'
                            ],
                        ]);
                    ?>
                </div>
            </div>
        </div>

        <div class="col-xl-9 col-lg-8 mx-auto">

            <?


            /** @var ZView $this */
            $baseUrl = $this->urlGetBase();


            if ($products) {

                echo ZCompareJobirWidget::widget([
                    'config'=>[
                        'borderColor'=>'border-success',
                        'selectColor' => '#00c851',
                        'br-color' => '#00c851',



                ]]);
                //echo ZMyCardWidget::widget(['config' => []]);
            

            } else {
            ?>
                <div class="my-5">
                    <div class="text-center d-block">

                        <!--<img width="200" class="img-fluid mx-auto d-block"
                             src="/render/images/ZHImgWidget/demo/asset/shopping-cart.gif">-->
                        <i class="fas fa-retweet fa-10x text-light" aria-hidden="true"></i>


                        <h3 class="mt-5 text-muted">
                            <?=Az::l('Нет выбранных товаров')  ?>
                        </h3>

                        <span class="mx-1 text-muted">
                                <?= Az::l('Добавьте товары в список для сравнения одинаковых категорий товаров.') ?>
                             </span><br>
                        <br>
                        <?
                        echo ZButtonWidget::widget([
                            'config' => [
                                'text' => 'Перейти к покупкам',
                                'color' => ZColor::color['green'],
                                'class' => 'ss',
                                'url' => '/shop/user/main/index.aspx',
                                'btnStyle' => ZButtonWidget::btnStyle['btn-success'],
                                'btnSize' => ZColor::btnSize['btn-md'],
                                'btnFontSize' => ZButtonWidget::btnScale['0.5'],
                                'btnRounded' => false,
                            ],

                        ]); ?>
                    </div>
                </div>
                <?
            }
            ?>
        </div>
    </div>


</div>
<?php 
  echo ZFooterAllWidget::widget([

  ]);
?>
<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
