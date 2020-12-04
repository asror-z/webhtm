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
use zetsoft\models\eyuf\Manual;
use zetsoft\widgets\former\ZViewWidget;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZFormBuilderWidget;

/** @var ZView $this */
$this->init();

$this->title('Просмотр  Справочника');
$this->icon = 'fa fa-calendar';

$id = $this->httpGet('id');
$model = Manual::findOne($id);

echo ZViewWidget::widget([
    'model' => $model,

]);
