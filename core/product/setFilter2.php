<?php


use zetsoft\dbitem\core\WebItem;
use zetsoft\models\page\PageAction;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\market\ZDilshodBoxWidget;
use zetsoft\widgets\cards\ZMarketCardsOnlyWidget;
use zetsoft\widgets\cards\ZProductCardWidget;
use function Dash\Curry\property;

/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Веб-действия';

$action->icon = 'fa fa-bar-chart';
$action->csrf = true;
$action->debug = true;




$action->type = WebItem::type['ajax'];

$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();



$properties = $this->httpPost('ZDynamicModel');

//vdd($properties);
$brands = $this->httpPost('brand');
$selected_options = $this->httpPost('selected_options');

$price_filter = $this->httpPost('price_filter');
/*$category_id = $this->httpPost('category_id');*/
$category_id = $this->httpPost('hidden_input');

Az::$app->market->product->setFilter($properties);
Az::$app->market->product->setPriceFilter($price_filter);
$products = Az::$app->market->product->allProducts($category_id);


echo ZMarketCardsOnlyWidget::widget([
    'model' => $products,
    'config' => [
        'widget' => ZProductCardWidget::class,
    ]
]);










