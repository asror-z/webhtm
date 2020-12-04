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
    $page_num = $this->httpGet('page_num');
    $range = $this->httpGet('range');

}else
{
    $page_num = ZArrayHelper::getValue($get, 'page_num');
    $range = ZArrayHelper::getValue($get, 'range');

}

echo Az::$app->tests->javohir->getByScroll($page_num, $range);

