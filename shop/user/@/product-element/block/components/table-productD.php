<?php
/** @var ZView $this */

use zetsoft\former\shop\ShopCompanyCardForm;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZDatatableWidgetNew;
use zetsoft\widgets\inputes\ZKStarRatingWidget;
use zetsoft\widgets\inputes\ZKTouchSpinWidget;
use zetsoft\widgets\market\ZSVGWidget;
use zetsoft\widgets\navigat\ZButtonWidget;



if (!isset($items)) {
    $item = new ShopCompanyCardForm();
    $item->id = 1;
    $item->image = 'https://picsum.photos/200/200';
    $item->name = 'Zetsoft';
    $item->rating = 2;
    
    $item->cart_amount = 3;
    $item->catalog_id = 3;

    $item->action = function ($model) {
        /** @var ShopCompanyCardForm $model */
        if ($model->cart_amount < 0) return null;
        return ZButtonWidget::widget([
            'config' => [
                'text' => Az::l('Добавить в корзину'),
                'btnStyle' => ZButtonWidget::btnStyle['btn-success'],
                'btnRounded' => false
            ]
        ]);
    };
    $items[] = $item;

};
$model = new ShopCompanyCardForm();
$model->configs->nameOff = [
    'cart_amount',
    'catalog_id'
];
$model->columns();
 //vdd($items);
echo ZDatatableWidgetNew::widget([
    'model' => $model,
    'data' => $items
]);
