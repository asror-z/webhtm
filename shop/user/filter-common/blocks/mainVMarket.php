<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

use zetsoft\dbitem\shop\ProductItem;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\inptest\ZRatyStarWidget;
use zetsoft\widgets\inputes\ZKStarRatingWidget;
use zetsoft\widgets\inputes\ZKTouchSpinWidget;
use zetsoft\widgets\inputes\ZPriceFormatWidget1;
use zetsoft\widgets\market\ZStarDobtcoWidget;
use zetsoft\widgets\market\ZSVGWidget;

$product = Az::$app->market->product->product($id ?? '12');

/** @var ZView $this */
if (!isset($type)) {
    $type = 'sale';
}


if (!isset($product)) {
    $product = new ProductItem();
    $product->id = $this->myId();
    $product->name = 'Арахисовая паста с медом 200г';
    $product->title = 'Test Desc';
    $product->new_price = '14825920';
    $product->price_old = '188920';
    $product->barcode = '34234234';
    $product->exist = ProductItem::exists['not'];
    $product->image = [
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
    $product->cart_amount = 3;
    $product->status = [
        $type
    ];

}

if ($product->cart_amount === null) {
    $product->cart_amount = 0;
}
?>

<?
$this->fileJs('/render/cards/ZVMarketWidget/asset/main1.js');
$this->fileJs('/render/cards/ZHCommonSaleWidget/asset/main.js');
$this->fileCss('/render/asrorz/css/vertical_card.css');

?>
<div class="col-lg-3 col-md-8 v-card pb-2 zcol">

    <div class="card w-100 v-card horizontal-vertical-card" data-product-id="<?= $product->id ?>"
         data-cart-amount="<?= $product->cart_amount ?>">

        <a href="<?= $product->url ?>" class="position-relative overflow-hidden zvertical-card"
           style='background-image: url("<?= $product->image[0] ?>")'>
            <div class="position-absolute p-2 d-flex">
                <?
                if (in_array(ProductItem::statuses['top_sell'], $product->status))
                    echo ZSVGWidget::widget([
                        'config' => [
                            'type' => ProductItem::statuses['top_sell']
                        ]
                    ]);
                ?>

                <div class="pl-3">
                    <?
                    if (in_array(ProductItem::statuses['free_delivery'], $product->status))
                        echo ZSVGWidget::widget([
                            'config' => [
                                'type' => ProductItem::statuses['free_delivery']
                            ]
                        ]);
                    ?>
                </div>

            </div>
            <div class="position-absolute" style="right: -5%; top: 5%">

                <? if (in_array(ProductItem::statuses['new'], $product->status) && !in_array(ProductItem::statuses['sale'], $product->status) && !$product->is_multi) { ?>
                    <span style="right: 0; top: 2%"
                          class="position-absolute ml-auto rounded-left green-bg-color p-1 mr-3 text-white rounded fe-08">
                  New
                </span>
                <? } ?>
            </div>


            <? if (!$product->is_multi) { ?>
                <span style="right: 0; bottom: 2%"
                      class="position-absolute ml-auto danger-color p-1 mr-1 text-white rounded fe-08">
                  <?= $product->discount ? $product->discount : '' ?> %
                </span>  <? /* } */ ?>
            <? } elseif ((!$product->is_multi) && (in_array(ProductItem::statuses['new'], $product->status))) { ?>

                <span style="right: 0; top: 2%"
                      class="position-absolute ml-auto rounded-left green-bg-color p-1 mr-1 text-white rounded fe-08">
                  New
                </span>

                <span style="right: 2%; bottom : 4%"
                      class="position-absolute ml-auto danger-color p-1 mr-1 text-white rounded fe-08">
                  <?= $product->discount ? $product->discount : '' ?> %
                </span>
            <? } //vdd($item->in_wish); ?>

        </a>

        <div class="card-body p-3">
            <div class="d-flex justify-content-between align-items-start">
                <a href="<?= $product->url ?>" class="text-dark text-truncate">
                    <div class="fe-12 text-truncate"><?= $product->name ?></div>
                </a>
                <div class="d-flex align-items-start">
                    <a role="button" onclick="add_wish_list(<?= $product->id ?>, $(this), false)" class="d-flex">
                        <i class="far fa-heart grey-text pr-1 mr-2 h4 <?= $product->in_wish ? 'text-danger' : '' ?>"></i>
                    </a>
                    <a role="button" onclick="add_compare_list(<?= $product->id ?>, $(this), false)" class="d-flex">
                        <i class="fa fa-chart-bar grey-text pr-1 h4 <?= $product->in_compare ? 'text-success' : '' ?>"></i>
                    </a>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <div class="text-success fe-12"><?= $product->exist ?></div>
                <div class="text-muted card-text"><?= Az::l('Артикул') ?>: <?= $product->barcode ?></div>
            </div>
            <div class="d-flex justify-content-between">
                <div class="w-75">
                    <div class="d-flex align-items-end flex-wrap">
                        <? if ($product->currencyType == ProductItem::currencyType['before']) { ?>
                            <div class="text-muted d-flex">
                                <? echo $product->currency ?>
                            </div>
                        <? } ?>
                        <div class="text-success fr-1">
                            <?
                            if (!$product->is_multi)
                                echo number_format($product->new_price, 2, '.', ' ');
                            else {
                                echo number_format($product->min_price, 2, '.', ' ');
                                if ($product->max_price !== null)
                                    echo ' - ' . number_format($product->max_price, 2, '.', ' ');
                                else
                                    echo '';
                            }
                            ?>
                        </div>
                        <? if ($product->currencyType == ProductItem::currencyType['after']) { ?>
                            <div class="text-muted d-flex align-items-center">
                                <?= $product->currency ?> <?= Az::l('за') ?> 1 <?= $product->measure ?>
                            </div>
                        <? } ?>
                    </div>
                    <? if (!$product->is_multi) { ?>
                        <div class="text-danger mt-2">
                            <strike class="h6"><?= number_format($product->price_old, 2, '.', ' '); ?></strike>
                        </div>
                    <? } ?>

                </div>


                <div class="float-right">
                    <?
                    echo ZKStarRatingWidget::widget([
                        'id' => 'rating_' . $id,
                        'name' => 'gggfg',
                        'config' => [
                            'show' => false,
                            'value' => $product->rating,
                        ]
                    ]);
                    ?>

                    <h6 class="card-text text-muted text-center">
                        <a href="/"><?= $product->reviewCount ?>
                            <?= Az::l('отзыва') ?>
                        </a>
                    </h6>
                </div>
            </div>

            <div>

            </div>
        </div>
        <div class="mx-2 footer-main">
            <? if (!$product->is_multi /*&& !$isCommon*/) : ?>
                <button id="add-card-<?= $product->id ?>"
                        class="w-100 mx-0 add-card btn button-bg-color text-white <?= $product->cart_amount > 0 ? "d-none" : "" ?>"
                        data-catalog-id="<?= $product->catalogId ?>"
                        onclick="addToCart($(this))"
                >
                    <?= Az::l('Добавить в корзину') ?>
                </button>

                <div id="input-<?= $product->id ?>" class="touch-main <?= $product->cart_amount > 0 ? " " : "d-none" ?>">
                    <div class="d-flex touch-main-children justify-content-center">
                        <div class="d-flex parent-clear w-75">
                            <?
                            echo ZKTouchSpinWidget::widget([
                                'name' => 'amount' . $product->id,
                                'id' => $product->id . $this->myId(),
                                'config' => [
                                    'min' => '0',
                                    'buttonup_txt' => '<i class="fa fa-plus px-2"></i>',
                                    'buttondown_txt' => '<i class="fa fa-minus px-2"></i>',
                                    'buttonup_class' => 'btn btn-success fp-18 rounded-right p-1',
                                    'buttondown_class' => 'btn btn-success fp-18 rounded-left p-1',
                                    'class' => 'text-center clear-add-btn',
                                    'initVal' => '1'
                                ],
                                'event' => [
                                    'startupspin' => <<<JS
                                    function(){
                                     //spinUp(product->id,product->catalogId);
                                    }
JS,
                                    'startdownspin' => <<<JS
                                    function(){
                                     //spinDown(product->id,product->catalogId);
                                    }
JS,

                                ]

                            ]);
                            ?>
                        </div>
                        <div class="v-card-clear-add" data-catalog-id="<?= $product->catalogId ?>"
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
            <? endif; ?>
        </div>
    </div>

</div>




