<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */
use zetsoft\models\place\PlaceCountry;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\inputes\ZSelect2Widget;

/** @var ZView $this */

$action = new WebItem();
$action->type = WebItem::type['ajax'];
$action->debug = false;

$model = new PlaceCountry();
$attribute = 'name';

echo ZSelect2Widget::widget([
    'model' => $model,
    'attribute' => $attribute
]);


