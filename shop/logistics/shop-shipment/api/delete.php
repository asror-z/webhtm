<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\shop\ShopOrder;
use zetsoft\system\Az;

$action = new WebItem();

$action->title = Azl . 'Назначение заказов курьеру';
$action->icon = 'fal fa-film';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;



$this->paramSet(paramAction, $action);

$checkKeys = $this->httpPost('checkKeys');
foreach ($checkKeys as $checkKey) {

    $model = ShopOrder::findOne($checkKey);
    $model->shop_shipment_id = null;
    $model->status_logistics = ShopOrder::status_logistics['shipment_ready'];
    $model->configs->rules = [
        [
            validatorSafe
        ]
    ];

    $model->save();

}
