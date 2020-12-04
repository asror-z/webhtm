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

use zetsoft\models\place\PlaceCountry;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\inptest\ZKSelect2AjaxWidget;
use zetsoft\widgets\inputes\ZKSelect2Widget;

$action->title = Azl . 'Веб-действия';

$action->icon = 'fa fa-cubes';
$action->debug = true;
$action->type = WebItem::type['ajax'];::type['part'];

echo 'salom';


$model = new PlaceCountry();
$attribute = 'name';

echo ZKSelect2Widget::widget([
    'model' => $model,
    'attribute' => $attribute
]);
