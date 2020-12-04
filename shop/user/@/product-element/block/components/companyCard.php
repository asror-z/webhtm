<?php

use zetsoft\dbitem\shop\ProductItem;
use zetsoft\system\kernels\ZView;
/**@var ZView $this */


$this->fileJs('/render/cards/ZVMarketWidget/asset/main2.js');
?>

<?php

use zetsoft\system\Az;
use zetsoft\widgets\inputes\ZKStarRatingWidget;
use zetsoft\widgets\inputes\ZKTouchSpinWidget;
use zetsoft\widgets\market\ZSVGWidget;


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

<div class="col-lg-12 col-md-12 col-sm-12 col-12 border p-2 mt-1">

    <div class="d-flex flex-wrap justify-content-center">

        <div class="col-lg-7 col-md-7 col-sm-7 col-7 c-card-header">

            <div class="col-lg-12 col-md-12 col-sm-12 col-12 c-card-header--items">

                <div class="d-flex justify-content-between">

                    <div class="col-lg-3 col-md-3 col-sm-5 col-5 p-0 c-card-image h-25">

                        <div class="">
                            <img src="<?= $item->images ?>" class="img-fluid " alt="" >
                        </div>

                    </div>

                    <div class="col-lg-9 col-md-7 col-sm-7 col-7 c-card-header--text">

                        <h5 class="mt-1"><?=$item->name ?></h5>

                    </div>
                    
                </div>

            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 col-12 c-card-events">

                <div class="d-flex">
                    <div class="c-card-stars p-0 mr-2 mt-2">

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
                    <div class="c-card-review">
                        <p class="mt-2">8 отзывов</p>
                    </div>
                </div>
                
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 col-12 c-card-paying">

            <!--    <p class="text-light m-0 p-0 fp-14">1200 людей купили этот товар</p>-->
                <p class="text-muted m-0 p-0 fp-14">Оплата: наличными, картой</p>

            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 col-12 d-flex c-card-footer p-0 mr-0">

                <i class="fas fa-truck fp-14 text-muted mt-1 ml-3"></i>
                <p class="text-muted fp-14 ml-2">Бесплатная доставка</p>

            </div>

        </div>

        <div class="col-lg-5 col-md-5 col-sm-5 col-5">

            <div class="col-lg-12 col-md-12 col-sm-12 col-12 c-card-right">

                <div class="d-flex">

                    <p class="ml-2 mt-1 text-muted"><del>16.000 сум</del></p>
                    <h6 class="ml-2 mt-1"><span class="badge badge-danger">-9%</span</h6>

                </div>

            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 col-12 c-card-right--price">

                <h3>10.000 сум</h3>

            </div>

            <div class="mt-3 c-card-right--btn">

                <button id="add-card-<?= $item->id ?>"
                        class="add-card btn btn-sm btn-success <?= $item->cart_amount > 0 ? "d-none" : "" ?>"
                        data-catalog-id="<?= $item->catalogId ?>"
                        onclick="addToCart($(this))">
                    <?= Az::l('Добавить в корзину') ?>
                </button>

                <div id="input-<?= $item->id ?>" class="touch-main <?= $item->cart_amount > 0 ? " " : "d-none" ?>">
                    <div class="d-flex touch-main-children justify-content-start">
                        <div class="d-flex parent-clear w-100">
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


<style>



    .right-button {
        width: 100px;
        height: 100px;
        border-radius: 10px;
        background-color: limegreen;
    }

</style>

<script>

            $(document).ready(function () {
                $('#add-card-<?= $item->id ?>').on("click", function () {
                    $('#input-<?= $item->id ?>').removeClass('d-none');
                    $(this).addClass('d-none');
                });
            })
        </script>
