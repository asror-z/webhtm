<?php

use zetsoft\system\Az;
use zetsoft\widgets\inputes\ZKStarRatingWidget;
use zetsoft\widgets\inputes\ZKTouchSpinWidget;
use zetsoft\widgets\market\ZSVGWidget;
use zetsoft\dbitem\shop\ProductItem;
use zetsoft\system\kernels\ZView;
/**@var ZView $this */

$this->fileJs('/render/cards/ZVMarketWidget/asset/main1.js');

if (!isset($product) || $product===null) {
    $item = new ProductItem();
    $item->id = 2;
    $item->name = 'Nike';
    $item->title = 'Test Desc';
    $item->new_price = '99 000';
    $item->price_old = '100 000';
    $item->barcode = '34234234';
    $item->exist = ProductItem::exists['not'];
    $item->images =
        'https://images.pexels.com/photos/1095550/pexels-photo-1095550.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500';
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
    $item->cart_amount = 0;

    $item->review = 400;
    $item->delivery_cost = 'Бесплатно';
    $item->productColor = 'белый';
}

//vdd(Az::$app->market->company->getCompanyList($item->id));
$items[]=$item;

?>


<div class="d-flex justify-content-between shadow-sm border p-2">
    <div class="d-flex flex-column ">
         <div class="d-flex justify-content-center align-items-end">
             <img src="<?= $item->images ?>" class="img-fluid" alt=""  style="max-width: 100px;">
             <div class="ml-1 fp-20 font-weight-bold"><?=$item->name ?></div>
         </div>
         <div class="d-flex">
             <div>
                 <?
                 echo ZKStarRatingWidget::widget([
                     'name' => 'gggfg',
                     'config' => [
                         'show' => false,
                         'class'=> '',
                         'icon' => '<i class="fas fa-star fp-12"></i>',

                     ]
                 ]);
                 ?>
             </div>
             <div class="d-flex align-items-end">
                 8 отзывов
             </div>
         </div>
         <div class="d-flex">
             <p class="text-muted m-0 p-0 fp-14">Оплата: наличными, картой</p>
         </div>
         <div class="d-flex align-items-center">
             <i class="fas fa-truck fp-14 text-muted"></i>
             <div class="text-muted fp-14 ml-1">Бесплатная доставка</div>
         </div>
    </div>
    <div class="d-flex flex-column justify-content-center">
        <div class="d-flex">
            <div class="text-muted font-weight-bold mt-1"><del>16.000 сум</del></div>
            <div class="d-flex align-items-start ml-1"><span class="badge badge-danger">-9%</span></div>
        </div>
        <div class="d-flex">
            <div class="font-weight-bold fp-20">10.000 сум</div>
        </div>
        <div class="d-flex">
            <div class="mt-3 footer-main">
                <button id="add-card-<?= $item->id ?>"
                        class="add-card btn btn-sm btn-success <?= $item->cart_amount > 0 ? 'd-none' : '' ?>"
                        data-catalog-id="<?= $item->catalogId ?>"
                        onclick="addToCart($(this))">
                    <?= Az::l('Добавить в корзину') ?>
                </button>
                
                <div id="input-<?= $item->id ?>" class="touch-main <?= $item->cart_amount > 0 ? '' : 'd-none' ?>  w-50">
                    <div class="d-flex touch-main-children justify-content-end">
                        <div class="d-flex parent-clear">
                            <?
                            echo ZKTouchSpinWidget::widget([
                                'name' => 'asds',
                                'config' => [
                                    'min' => '0',
                                    'buttonup_txt' => '<i class="fas fa-plus"></i>',
                                    'buttondown_txt' => '<i class="fas fa-minus"></i>',
                                    'buttonup_class' => 'btn btn-success fp-14 rounded-right p-1',
                                    'buttondown_class' => 'btn btn-success fp-14 rounded-left p-1',
                                    'class' => 'text-center clear-add-btn',
                                    'initVal' => '1'
                                ],
                                'event' => [
                                    'startupspin' => <<<JS
                                    function(){
                                     spinUp($item->id,$item->catalogId);
                                    }
JS,
                                    'startdownspin' => <<<JS
                                    function(){
                                     spinDown($item->id,$item->catalogId);
                                    }
JS,

                                ]

                            ]);
                            ?>
                        </div>
                        <div class="v-card-clear-add" data-catalog-id="<?= $item->catalogId ?>"
                             onclick="deleteFromCart($(this))">
                            <?
                            echo ZSVGWidget::widget([
                                'config' => [
                                    'type' => 'basket_delete',
                                ]
                            ])
                            ?>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

