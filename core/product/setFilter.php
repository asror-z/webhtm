<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\ajaxify\ZInfinityScrollAjaxWidget;

/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Веб-действия';

$action->icon = 'fa fa-bar-chart';
$action->csrf = false;
$action->debug = true;




$action->type = WebItem::type['ajax'];

$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

$post = $this->httpPost();

$properties = ZArrayHelper::getValue($post, 'ZDynamicModel');
$brand = ZArrayHelper::getValue($post, 'brand');
$price = ZArrayHelper::getValue($post, 'price_filter');

ZArrayHelper::remove($properties, 'hidden_input');

$this->sessionSet('filter', $properties);

$this->sessionSet('brand_filter', $brand);

$this->sessionSet('price_filter', $price);

$category_id = $this->httpGet('category_id');

$market_id = $this->httpGet('market_id');

if (empty($market_id))
    $market_id = 978;

$selected_options = $this->httpPost('selected_options');

if ($market_id === null)
    echo ZInfinityScrollAjaxWidget::widget([
        'config' => [
            'limit' => 12,
            'cols' => 2,
            'ajaxMethod' => ZInfinityScrollAjaxWidget::method['get'],
            'namespace' => 'market',
            'service' => 'product',
            'method' => 'allProducts',
            'args' => $category_id . '|' . null . '|1|10|[]',
        ]
    ]);
else
    echo ZInfinityScrollAjaxWidget::widget([
        'config' => [
            'limit' => 12,
            'cols' => 2,
            'ajaxMethod' => ZInfinityScrollAjaxWidget::method['get'],
            'namespace' => 'market',
            'service' => 'product',
            'method' => 'allProducts',
            'args' => $category_id . '|' . $market_id . '|1|10|[]',
        ]
    ]);
