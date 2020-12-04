<?php


use zetsoft\dbitem\core\WebItem;
use zetsoft\models\page\PageAction;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\system\Az;
/** @var ZView $this */


$action = new WebItem();
$action->title = Azl . 'Веб-действия';

$action->icon = 'fa fa-bar-chart';
$action->csrf = true;
$action->debug = true;



$this->paramSet(paramAction, $action);


$action->type = WebItem::type['ajax'];
    $element_id = $this->httpGet("element_id");
    $amount = $this->httpGet("amount");
    Az::$app->market->product->setToCartByElementId($element_id, $amount, 'set');

    $products = Az::$app->market->product->cartOrders();
    $total = 0;
    foreach ($products as $product) {
        $products = Az::$app->market->product->cartOrders();
        $total += $product->price[0] * $product->amount;
    }
    echo $total;











