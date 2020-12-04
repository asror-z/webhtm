<?php

use zetsoft\dbitem\shop\PropertyItem;
use zetsoft\dbitem\data\ALLApp;
use zetsoft\dbitem\data\Config;
use zetsoft\dbitem\data\Form;
use zetsoft\former\ALL\AzimForm;
use zetsoft\former\shop\ShopFilterForm;
use zetsoft\service\forms\Active;
use zetsoft\system\actives\ZAjaxForm;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\inputes\ZHCheckboxButtonGroupWidget;
use zetsoft\widgets\inputes\ZKRangeWidget;
use zetsoft\widgets\market\ZCategoryWidget;
use zetsoft\widgets\market\ZHotOfferWidget;
use zetsoft\widgets\market\ZMegaMenuWidget;
use zetsoft\widgets\market\ZMenuWidget;
use zetsoft\widgets\market\ZProductBoxWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\navigat\ZButtonWidget2;
use zetsoft\dbitem\shop\ProductItem;

/*
 * Template
 * /render/market/XeMart%20-%20Ecommerce%20Template/html/04-category.html
 * */
/** @var ZView $this */
$this->title = Az::l('Сравнить');
$action->icon = 'fa fa-random';
         //bozorMain


?>
<section class="menu">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <?
                echo ZMenuWidget::widget([
                    'name' => '123',
                    'config' => [
                        'open' => false,
                        'name' => 'Категории',
                    ],
                ]);
                ?>
            </div>
            <div class="col-md-9">
                <?
                echo ZMegaMenuWidget::widget([
                    'name' => '123',
                    'config' => [
                        'open' => true
                    ],
                ]);
                ?>
            </div>
        </div>
        <div class="row">
            <div id="contento" class="mb-3">
                <?
                echo \zetsoft\widgets\market\ZDilshodBoxWidget::widget([
                    //'model' => $model,
                    'model' => Az::$app->market->product->allProducts(),
                    'config' => [
                        'widget' => zetsoft\widgets\market\ZProductCardWidget::class,
                        'categoryId' => 4
                    ]
                ]);
                ?>
            </div>
        </div>
    </div>
</section>


<style>

    li:last-child {
        text-decoration: none !important;
    }

    #sendValues {
        visibility: hidden;
    }

    .partners h2 {
        text-align: center;
        font-size: 30px;
        font-weight: bold;
        color: #10b410;
    }

    .topNavbarIcons i {
        font-size: 28px;
        color: #10b410;
        padding-bottom: 5px;
    }

</style>



