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

$category_id = $this->httpGet('category_id');
$category_id = (int)$category_id;

vdd(Az::$app->market->product->afterEditCorecategory($category_id));
//vdd(Az::$app->market->product->afterEditCorecategory(549));
