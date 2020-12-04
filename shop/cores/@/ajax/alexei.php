<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */


use zetsoft\models\place\PlaceCountry;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\widgets\former\ZViewWidget;
use zetsoft\widgets\places\ZAmchartWidget;


$action->title = Azl . 'Просмотр  core countries';
$action->icon = 'fa fa-rocket rss';

$id = $this->httpGet('id');

$model = PlaceCountry::findOne($id);

echo ZViewWidget::widget([
    'model' => $model,
    'config' => [
        'tableColor' => ZColor::color['primary-color'],
        'theadColor' => ZColor::color['teal'],
    ]

]);
