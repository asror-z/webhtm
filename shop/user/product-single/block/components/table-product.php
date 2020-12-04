<?php
/** @var ZView $this */

use zetsoft\former\shop\ShopCompanyCardForm;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZDatatableWidgetNew;

/*$get = $this->sessionGet('catalogForm');
$productId = ZArrayHelper::getValue($get, 'product_id');
unset($get['product_id']);
$set = Az::$app->market->cart->getcatalogsByElement($productId, $get);
$items=$set;*/
//vdd($items);

if (!isset($items)) {
    $item = new ShopCompanyCardForm();
    $item->image = 'https://picsum.photos/200/200';
    $item->name = 'Zetsoft';
    $item->rating = 3;

    $item->cart_amount = 3;
    $item->catalogId = 3;
    $item->id = $this->myId();

    $item->action = function ($model) use ($item) {
        /** @var ShopCompanyCardForm $model */
        if ($model->cart_amount < 0) return null;
        return  $this->require( '/render/cards/ZCompanyCardWidget/block/AddToCartButton.php', [
            'item' => $item
        ], 'check');
        /*ZButtonWidget::widget([
            'config' => [
                'text' => Az::l('Добавить в корзину'),
                'btnStyle' => ZButtonWidget::btnStyle['btn-success'],
                'btnRounded' => false
            ]
        ]);*/
    };
    $items[] = $item;

};
 

$model = new ShopCompanyCardForm();

$model->action = function ($model, $item, $attribute, $column){

    return $this->require( '/render/cards/ZCompanyCardWidget/block/AddToCartButtonForPriceProductSingle.php', [
        'item' => $item
    ]);

};
/** @var ShopCompanyCardForm $item */
$model->new_price = function ($model, $item, $attribute, $column){
    $formatter = new NumberFormatter('ru_RU',  NumberFormatter::CURRENCY);
    $price = $formatter->formatCurrency($item->new_price, 'UZS');
     if ($item->currencyType === ShopCompanyCardForm::currencyType['after'])
        return $price . $item->currency . ' за ' . $item->measure;
     return $item->currency . $price . ' за ' . $item->measure;;


};
/** @var ShopCompanyCardForm $item */
$model->name = function ($model, $item, $attribute, $column){
    $code = <<<HTML
<a href="{url}">{text}</a>
HTML;
     return strtr($code, [
        '{url}' => $item->url,
        '{text}' => $item->name
     ]);
};

$model->configs->nameOn = [
       'id',
       'image',
       'name',
       'market',
       'rating',
       'new_price',
       /*'measure',*/
       'action'
                        ];
$model->columns();
 //vdd($items);
echo ZDatatableWidgetNew::widget([
    'model' => $model,
    'data' => $items
]);
