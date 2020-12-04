<?php


use zetsoft\dbitem\core\WebItem;
use zetsoft\models\ware\WareAccept;

$action = new WebItem();

$action->title = Azl . 'Приёмка от курьера';


$action->icon = 'fal fa-film';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = false;



$this->paramSet(paramAction, $action);

$status = $this->httpGet('status');

$ware_accept = WareAccept::findOne($this->httpGet('ware_accept_id'));
$ware_accept->status = $status;
$ware_accept->configs->rules = [
    [
        validatorSafe
    ]
];
$ware_accept->save();

