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
use phpDocumentor\Reflection\Types\Array_;
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

$items = Az::$app->market->category->generateDBMenuItems();

$items_child=[];

foreach ($items as $item){
    foreach ($item->items as $prop){
            $items_child=array_merge($items_child,$prop->items);
        
    }
}


/** @var Collection $model */

$model = collect($items_child);
if ($page !== 0) {
    $skip = $page * $limit;
}

$model_part = $model
    ->skip($skip)
    ->take($limit);

if ($skip > $model->count()){
    return null;
}
$html = null;
foreach ($model_part as $item) {
    $html .= $this->require( '/render/cards/ZVMarketWidget/ready/card.php', [
        'item' => $item
    ]);
}

echo $html;


