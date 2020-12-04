<?php


use zetsoft\dbitem\core\WebItem;
use zetsoft\models\page\PageAction;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZDynaWidget;

/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Веб-действия';

$action->icon = 'fa fa-bar-chart';
$action->debug = false;
$action->csrf = false;
$action->type = WebItem::type['ajax'];

$get = $this->httpGet('ZDynamicModel');

if (empty($get)) {
    $catalog_id = $this->httpGet('catalog_id');
    $options = $this->httpGet('options') ?? [];
    $amount = $this->httpGet('amount') ?? 1;
    echo \zetsoft\system\Az::$app->market->cart->addToCart($catalog_id, $amount = 1);
} else {

//$get = $this->httpGet('ZDynamicModel');

    $catalog_id = $get['catalog_id'];
    unset($get['catalog_id']);
    $amount = $get['amount'] ?? 1;
    unset($get['amount']);
    /*$options = $get;*/
    $options = [];

    /*vdd($options);*/
    /*$amount2 = $this->httpGet("ZDynamicModel[2]");
    echo $amount2;*/
    echo Az::$app->market->cart->addToCart($catalog_id, $amount = 1);
}
