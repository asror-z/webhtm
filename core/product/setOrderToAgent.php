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


if (empty($get)){
    $agent = $this->httpGet('agent');
    $status = $this->httpGet('status');
    $checkList = $this->httpGet('checkList');
}else
{
    $agent = ZArrayHelper::getValue($get, 'agent');
    $status = ZArrayHelper::getValue($get, 'status');
    $checkList = ZArrayHelper::getValue($get, 'checkList');
}

echo Az::$app->market->operator->setOrdersToAgent($agent, $checkList,$status);

