<?php


use zetsoft\dbitem\core\WebItem;
use zetsoft\models\page\PageAction;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZDynaWidget;

/** @var ZView $this */
$action = new WebItem();

$action->csrf = true;
$action->debug = true;
$action->cache = false;
$action->call = null;
$action->cacheHttp = false;

$this->paramSet(paramAction, $action);

$action->type = WebItem::type['ajax'];

$this->paramSet(paramAction, $action);
$get = $this->httpGet('ZDynamicModel');
/*vdd($this->httpGet());*/
if (empty($get)){
    $amount = $this->httpGet('amount');
    $category = $this->httpGet('catalog_id');

}else
{
    $amount = ZArrayHelper::getValue($get, 'amount');
    $category = ZArrayHelper::getValue($get, 'catalog')[0];
}

echo Az::$app->market->cart->setToCart($category, $amount);

