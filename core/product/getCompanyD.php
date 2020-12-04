<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\shop\ProductItem;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZJsonHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\ajaxify\ZInfinityScrollAjaxWidget;

/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Веб-действия';

$action->icon = 'fa fa-bar-chart';
$action->csrf = false;
$action->debug = true;

$action->cache = false;
$action->call = null;
$action->cacheHttp = false;


$action->type = WebItem::type['ajax'];

$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();


$get = $this->httpPost('ZDynamicModel');

$productId = ZArrayHelper::getValue($get, 'product_id');

unset($get['product_id']);

$session = $get;
if (!empty($get))
    $this->sessionSet('catalogForm', $session);

if ($get === null)
    $get = [];

$get_result = [];
foreach ($get as $a) {
    $get_result = ZArrayHelper::merge($get_result,$a);
}
$get = $get_result;

$set = Az::$app->market->cart->getcatalogsByElement($productId, $get);
//vdd($set);
if (is_array($set))
    foreach ($set as $key => $magazin) {
        echo $this->require( '/render/cards/ZCompanyCardWidget/ready/main.php', [
            'item' => $magazin
        ],
        );

    }
if (empty($set))
    echo '<div class="text-center col-md-6 offset-md-3 fp-18">' . Az::l('В настоящее время нет продукта с этими функциями, пожалуйста, попробуйте изменить настройки выбора.') . '</div>';
