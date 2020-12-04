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
use zetsoft\widgets\cards\ZMiniCardWidget;
use zetsoft\widgets\former\ZListViewWidget;
use zetsoft\widgets\themes\ZCardWidget;


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

$items = Az::$app->market->product->getAllProductsByCompany(57, 550);



/** @var Collection $model */
$model = $items;
/*$model = collect($items);*/
if ($page !== 0) {
    $skip = $page * $limit;
}

/*$model_part = $model
    ->skip($skip)
    ->take($limit);*/

/*if ($skip > $model->count()){
    return null;
}*/
/*$html = null;
foreach ($model_part as $item) {
    $html .= $this->require( $requireUrl, [
        'item' => $item
    ]);
}
echo $html;*/

echo ZListViewWidget::widget([
    'data' => $model,
    'config' => [
        'itemView' => function($model, $key, $index, $widget) use ($requireUrl){
           /* return $this->require( $requireUrl, [
                'item' => $model
            ]);*/
            return ZMiniCardWidget::widget([
                'config' => [
                    'name' => $model->id
                ]
            ]);
        },
        'pageSize' => $limit,
        'page' => $page
    ]
]);


