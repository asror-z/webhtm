<?php

use DebugBar\DataFormatter\VarDumper\DebugBarHtmlDumper;
use zetsoft\dbitem\core\WebItem;
use zetsoft\service\forms\Active;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\navigat\ZBreadcrumbsWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\navigat\ZReadMoreWidget;

/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Продукты по категориям';
$action->icon = 'fa fa-area-chart';
$action->type = WebItem::type['ajax'];
$action->csrf = false;
$action->debug = true;



$this->fileJs('/render/ajaxify/ZInfinityScrollAjaxWidget/asset/main.js');

$marketId = $this->httpGet('marketId');
$categoryId = $this->httpGet('categoryId');
$this->paramSet(paramAction, $action);
$this->title();
$this->toolbar();

/** @var ZView $this */
$this->fileCss('/render/asrorz/css/loader.css');

$post = $this->httpPost();
$filter = ZArrayHelper::getValue($post, 'ZDynamicModel');
$brand = ZArrayHelper::getValue($post, 'brand');

$price = ZArrayHelper::getValue($post, 'price_filter');
ZArrayHelper::remove($filter, 'hidden_input');

if (isset($filter))
    $this->sessionSet('filter', $filter);

if (isset($brand))
    $this->sessionSet('brand_filter', $brand);


if (isset($price))
    $this->sessionSet('price_filter', $price);


$items = Az::$app->market->product->allProducts($categoryId, null,
    1, 10, []);

foreach ($items as $item) {

    echo $this->require( '/render/cards/ZHCommonSaleWidget/ready/main.php', [
        'item' => $item,
        'isCommon' => false
    ]);

    echo $this->require( '/render/cards/ZVMarketWidget/ready/main.php', [
        'item' => $item,
        'isCommon' => false
    ]);
}


