<?php


use zetsoft\dbitem\core\WebItem;
use zetsoft\models\page\PageAction;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\market\ZDilshodBoxWidget;
use function Dash\Curry\property;

/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Веб-действия';

$action->icon = 'fa fa-bar-chart';
$action->csrf = true;
$action->debug = true;

$action->cache = false;


$this->paramSet(paramAction, $action);

$action->type = WebItem::type['ajax'];

$properties = $this->httpPost('ZDynamicModel');
$price_filter = $this->httpPost('price_filter');

$category_id = $this->httpPost('category_id');
Az::$app->market->productTest->setFilter($properties);
Az::$app->market->productTest->setPriceFilter($price_filter);
  //vdd(Az::$app->market->productTest->allProducts($category_id));
echo ZDilshodBoxWidget::widget([
    'model' => Az::$app->market->productTest->allProducts($category_id),
    'config' => [
        'widget' => ZProductCardWidget::class,
    ]
]);










