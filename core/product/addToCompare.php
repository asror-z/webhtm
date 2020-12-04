<?php


use zetsoft\dbitem\core\WebItem;
use zetsoft\models\page\PageAction;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\models\shop\ShopElement;

/** @var ZView $this */

$action = new WebItem();

$action->title = Azl . 'Веб-действия';

$action->icon = 'fa fa-bar-chart';
$action->debug = false;
$action->csrf = false;
$action->type = WebItem::type['ajax'];

$this->paramSet(paramAction, $action);

$product_id = $this->httpGet('product_id') ?? '';


Az::$app->market->wish->writeCompare($product_id);
$this->sessionGet('compare');









