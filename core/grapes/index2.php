<?php

use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZGrapesJsWidgetMirbosit;


$form = $this->activeBegin();

echo \zetsoft\widgets\former\ZFormWidget::widget([
    'model' => new \zetsoft\models\page\PageAction(),
    'form' => $form,
]);


echo \zetsoft\widgets\former\ZFormWidget::widget([
    'model' => new \zetsoft\models\menu\Menu(),
    'form' => $form,
]);

$this->activeEnd();
