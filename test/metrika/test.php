<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */


use zetsoft\dbitem\core\WebItem;
use zetsoft\models\place\PlaceCountry;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZDynaWidget;

global $boot;
/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'test';
$action->icon = 'fa fa-area-chart';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;
$action->layout = true;
$action->layoutFile = 'login';


$model = new PlaceCountry();

echo ZDynaWidget::widget([
    'model' => $model
]);


?>


