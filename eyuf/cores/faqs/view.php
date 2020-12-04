<?php


use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\themes\ZColWidget;
use zetsoft\widgets\themes\ZRowWidget;

ZRowWidget::begin();
ZColWidget::begin([
    'config' => [
        'width' => 12
    ]
]);

echo ZFormBuildWidget::widget([
    'model' => $form,
    'config' => [
        'viewMode' => true
    ]
]);

ZColWidget::end();
ZRowWidget::end();


