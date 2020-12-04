<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\shop\ProductItem;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\inputes\ZSelect2Widget;
use zetsoft\widgets\market\ZCompareJavohirWidget;
use zetsoft\widgets\market\ZCompareJobirWidget;
use zetsoft\widgets\market\ZCompareWidget;
use zetsoft\widgets\market\ZFooterAllWidget;
use zetsoft\widgets\market\ZFooterAllWidgetOrg;
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



$products = Az::$app->market->session->getCompareProductItems();

if (empty($product)) {
    $properties = [];

    $property = new \zetsoft\dbitem\shop\PropertyItem();
    $property->name = 'dasdasdsad';
    $property->branch = 'dasdasdsad';
    $property->items = [
        'dasdsad',
        'dasdsad',
        'dasdsad',
        'dasdsad',
    ];

    $properties[] = $property;
    $properties[] = $property;
    $properties[] = $property;
    $properties[] = $property;
    $properties[] = $property;
    $properties[] = $property;
    //vdd($properties);
    $item = new \zetsoft\dbitem\shop\MultiProductItem();
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
    $item->allProperties = $properties;
    $item->properties = $properties;
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
    <style>
        .comparison-table{
            overflow-x: scroll;
        }
    </style>
</head>
<body class="<?= ZWidget::skin['white-skin'] ?>">
<?php


$this->beginBody();
require Root . '/webhtm/block/header/mainM.php';
require Root . '/webhtm/block/navbar/main.php';
require Root . '/render/menus/ZSidebarWidget/ready/main.php';

?>
<div class="container-fluid pb-4">
    <div class="row">

        <div class="col-md-12 mx-auto">
            <?
            /** @var ZView $this */
            $baseUrl = $this->urlGetBase();
            $products = Az::$app->market->session->getCompareProductItems();
            if (!empty($products)) {
                
                echo ZCompareWidget::widget([
                    'data' => $products,
                    'config' => [
                        'borderColor' => 'border-success',
                        'selectColor' => '#00c851',
                        'br-color' => '#00c851',
                    ]
                ]);
            } else {
                ?>
                <div class="my-5">
                    <div class="text-center d-block">
                        <i class="fas fa-retweet fa-10x text-light" aria-hidden="true"></i>

                        <h3 class="mt-5 text-muted">
                            <?= Az::l('Нет выбранных товаров') ?>
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
                                'url' => '/shop/user/main/main.aspx',
                                'btnStyle' => ZButtonWidget::btnStyle['btn-success'],
                                'btnSize' => ZColor::btnSize['btn-md'],
                                'btnFontSize' => ZButtonWidget::btnScale['0.5'],
                                'btnRounded' => false,
                            ],
                        ]); ?>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>
<div class="mt-4">
    <?php
    echo ZFooterAllWidgetOrg::widget([

    ]);
    ?>
</div>

<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
