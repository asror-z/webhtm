<?php


use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\shop\ProductItem;
use zetsoft\models\page\PageAction;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\market\ZCartReviewWidget;
use zetsoft\widgets\market\ZShopCardWidget;
use zetsoft\widgets\navigat\ZButtonWidget;

/** @var ZView $this */

$action = new WebItem();

$action->title = Azl . 'Веб-действия';

$action->icon = 'fa fa-bar-chart';
$action->debug = false;
$action->csrf = false;
$action->type = WebItem::type['html'];;

/*
$productlar = <<<HTML
<div class="cart-contento">
    <div class="content-item d-flex justify-content-between product_container">
        <div class="cart-img w-25">
            <a href="{url}"><img src="{img}" alt=""></a>
        </div>
        <div class="cart-disc w-50 text-center">
            <p><a href="{url}">{name}</a></p>
            <span>{amount} X </span><span>{price}</span>
        </div>
        <div class="delete-btn w-25 text-center">
            <button  style="z-index: 5" class = "remove_from_cart_button btn btn-outline-success" data-id="{element_id}">
             <i style="z-index: -1" class="fa fa-trash-o"></i>
             </button>
        </div>
    </div>
</div>

HTML;

$totalAndButton = <<<HTML
    <div class="cart-btm">
        <p class="text-left">{subTotal}:<span class="text-right">{currency} <span id="total_price">{total}</span></span></p> 
        {button}
    </div>
HTML;*/


/** @var ProductItem[] $products */
/*$products = Az::$app->market->product->cartOrders();
$productlar_ready = '';

foreach ($products as $product) {
    $productlar_ready .= strtr($productlar, [
        '{url}' => $product->url,
        '{img}' => $product->image[0] ?? 'not foun',
        '{name}' => $product->name,
        '{price}' => $product->price[0],
        '{element_id}' => $product->id,
        '{amount}' => $product->cart_amount,
    ]);
}


$button = ZButtonWidget::widget([
    'config' => [
        'url' => '/customer/main/checkout.aspx',
        'btnType' => ZButtonWidget::btnType['link'],
        'text' => Az::l('Проверять'),
        'hasIcon' => false,
        'btnStyle' => ZButtonWidget::btnStyle['btn-success'],
    ]
]);
$total = 0;
$currency = '';
foreach ($products as $product) {
    $total += $product->price[0] * $product->cart_amount;
    $badge_code = $product->cart_amount;
    $currency = $product->currency;
}
$total_ready = '';
$total_ready .= strtr($totalAndButton, [
    '{subTotal}' => Az::l('ПРОМЕЖУТОЧНЫЙ ИТОГ'),
    '{total}' => $total,
    '{currency}' => $currency,
    '{button}' => $button,
]);


echo $productlar_ready . $total_ready;*/
$this->pjaxBegin();
echo ZShopCardWidget::widget([]);

?>

<script>

   

    $(".remove_from_cart_button").on("click", function() {
        var catalog_id = $(this).data('catalogid');
        var el = $(this);
        $.ajax({
            type: "GET",
            url: "/shop/core/product/setToCart.aspx",
            data: {
                catalog_id: catalog_id,
                amount    : 0,
            },
            success: function(data){
                el.parents(".product_item:first").remove();
            },
            error:  function() {
                alert('error');
            }
        });
    });

</script>


<?php
$this->pjaxEnd();
?>






