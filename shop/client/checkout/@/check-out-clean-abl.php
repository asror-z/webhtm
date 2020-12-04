
<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\shop\ProductItem;
use zetsoft\dbitem\shop\SingleProductItem;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\inputes\ZHCheckboxWidget;
use zetsoft\widgets\market\ZFooterAllWidget;
use zetsoft\widgets\market\ZInputSpinnerWidget;
use zetsoft\widgets\themes\ZCardWidget;


/** @var ZView $this */

$action = new WebItem();

$action->title = Azl . 'Проверка покупки';
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

/** @var ZView $this */
if(!isset($item)){

    $item = new SingleProductItem();
    $item->id = 2;
    $item->name = 'Арахисовая паста с медом 200г';
    $item->title = 'Test Desc';
    $item->new_price = 14825920;
    $item->price_old = 188920;
    $item->barcode = 34234234;
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
    $item->sale = 'sdadsa';
    $item->is_multi = false;
    $item->in_wish = true;
    $item->in_compare = false;

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
require Root . '/webhtm/block/navbar/main.php';
?>


<div class="p-3 mt-2">
    <div class="row col-12">
        <div class="col-9 p-0 ">
            <?
            ZCardWidget::begin([
                'config' => [
                    'title' => Az::$app->view->title,
                    'type' => ZCardWidget::type['dynCard'],
                ]
            ]);


           echo $this->require( '/webhtm/shop/client/checkout/blocks/table.php', ['item' => $item]);


            ZCardWidget::end();
            ?>
        </div>
        <div class="col-md-3 d-flex flex-wrap h-100">
            <div class="col-12 h-25">
                <?
                ZCardWidget::begin([
                    'config' => [
                        'title' => 'Адреса',
                        'type' => ZCardWidget::type['dynCard'],
                    ]
                ]);
                ?>
                <div>
                    <p>Мои адреса</p>
                    <?

                    $item = [
                        'Qora-Qamish' => 'Кара-Камиш',
                        'Qora-Qamish 2/4' => 'Кара-Камиш 2/4',
                        'Qora-Qamish 2/3' => 'Кара-Камиш 2/3',
                    ];


                    foreach ($item as $value){
                        echo ZHCheckboxWidget::widget([
                            'config' => [
                                'placeholder' => $value
                            ]
                        ]);
                    }

                    ?>
                    <div class="d-flex w-100 mt-3 justify-content-center">
                        <a href="/client/checkout/add-adress.aspx" class="btn btn-md btn-block btn-outline-success">Добавить Адрес</a>
                    </div>

                </div>
                <?
                ZCardWidget::end();
                ?>


            </div>
            <div class="col-12 h-25 mt-3">
                <?
                ZCardWidget::begin([
                    'config' => [
                        'title' => 'Заказ товара',
                        'type' => ZCardWidget::type['dynCard'],
                        
                    ]
                ]);
                ?>
                <div class="text-center">
                    <p>Заказать товар</p>
                    <p>Каким способом вы будете платить?</p>
                    <ul class="d-flex">
                        <li class="d-inline-block border_side ml-2"><a class="position-relative d-table" href=""><img alt="Max-width 100%" class="mw-100 position-absolute" src="/render/market/ZFooterMarket/assets/img/click.jpg" ></a></li>
                        <li class="d-inline-block border_side ml-2"><a class="position-relative d-table" href=""><img alt="Max-width 100%"  class="w-100 h-100 position-absolute" src="/render/market/ZFooterMarket/assets/img/payme.jpg" ></i></a></li>
                        <li class="d-inline-block border_side ml-2"><a class="position-relative d-table" href=""><img alt="Max-width 100%" class="mw-100 position-absolute" src="/render/market/ZFooterMarket/assets/img/uzcard.jpg" ></i></a></li>
                    </ul>
                    <div class="d-flex w-100 mt-3 justify-content-center">

                        <button class="btn btn-md btn-block btn-outline-success">Сделать заказ</button>
                    </div>

                </div>
                <?
                ZCardWidget::end();
                ?>

            </div>
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
