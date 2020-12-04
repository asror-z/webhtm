<?php


use zetsoft\models\place\PlaceCountry;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\notifier\ZSweetAlert2Widget;

$model = new \zetsoft\models\page\PageAction();


echo \zetsoft\widgets\former\ZDynaWidget::widget([
    'model' => $model
]);

/** @var ZView $this */

//echo \zetsoft\widgets\former\ZSettingBtnWidget::widget();
