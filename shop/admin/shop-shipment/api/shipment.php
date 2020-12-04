<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\shop\ShopOrder;

$action = new WebItem();

$action->title = Azl . 'Назначение заказов курьеру';
$action->icon = 'fal fa-film';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;



$this->paramSet(paramAction, $action);

$checkKeys = $this->httpPost('checkKeys');
$shop_shipment_id = $this->httpGet('shop_shipment_id');

foreach ($checkKeys as $checkKey) {

    $model = ShopOrder::findOne($checkKey);
    $model->shop_shipment_id = $shop_shipment_id;
    $model->status_logistics = ShopOrder::status_logistics['courier_appointment'];
    $model->configs->rules = [
        [
            validatorSafe
        ]
    ];
    $model->save();

}
