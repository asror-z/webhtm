<?php

use zetsoft\system\kernels\ZView;
use zetsoft\widgets\inputes\ZKSelect2Widget;

/** @var ZView $this */
$model = $this->httpGet('model');
$addModel = Az::$app->smart->widget->addModel();
$modelAttributes = Az::$app->smart->widget->getModelAttributes();

echo ZKSelect2Widget::widget([
     'data' => $modelAttributes[$model]
]);
