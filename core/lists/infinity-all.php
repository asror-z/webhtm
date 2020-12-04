<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\webs\lists;


use Spatie\Typed\Collection;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZVarDumper;
use zetsoft\system\kernels\ZAction;
use zetsoft\widgets\inputes\ZKStarRatingWidget;

$page = $this->httpGet('page');
$limit = $this->httpGet('limit');
$requireUrl = $this->httpGet('requireUrl');

$serviceItem = Az::$app->utility->execs->itemHttp();
vdd($serviceItem);
$items = Az::$app->utility->execs->service($serviceItem);

$skip = 0;
Az::$app->search->sorter->data = $items;
/** @var Collection $model */
$model = Az::$app->search->sorter->item();
//$model = collect($items);
/*
 *
 * if ($page !== 0) {
    $skip = $page * $limit;
}

$model_part = $model
    ->skip($skip)
    ->take($limit);

if ($skip > $model->count()) {
    return null;
}*/
$model->simplePaginate(5);
$html = null;
foreach ($model_part as $item) {
    $html .= $this->require( $requireUrl, [
        'item' => $item
    ]);
}
return $this->generateContent($html);
