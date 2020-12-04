<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */


/** @var ZView $this */

use Illuminate\Support\Collection;
use zetsoft\dbitem\core\WebItem;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;

$action = new WebItem();

$action->title = Azl . 'Веб-действия';
$action->icon = 'fa fa-globe';
$action->type = WebItem::type['html'];
$action->csrf = false;
$action->debug = true;



$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

$page = $this->httpPost('page');
$limit = $this->httpPost('limit');
$requireUrl = $this->httpPost('requireUrl');
$itemAttribute = $this->httpPost('itemAttribute');

$items = Az::$app->market->product->allProducts();

/** @var Collection $model */

$model = collect($items);
if ($page !== 0) {
    $skip = $page * $limit;
}

$model = $model
    ->skip($skip)
    ->take($limit);

$html = null;
foreach ($model as $item) {
    $html .= $this->require( $requireUrl, [
        'item' => $item
    ]);
}
echo $html;


