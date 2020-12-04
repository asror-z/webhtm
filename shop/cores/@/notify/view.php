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
use zetsoft\models\auto\ChatNotify;
use zetsoft\system\Az;
use zetsoft\widgets\former\ZViewWidget;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZFormWizardWidget;

/** @var ZView $this */


$action->title = Azl . 'Просмотр  Уведомления';
$action->icon = 'fa fa-industry';

$action->debug = true;
$action->type = WebItem::type['html'];

$id = $this->httpGet('id');
$model = ChatNotify::findOne($id);
$model->configs->nameOn = [
    'title',
    'text',
    'time',

    
];
echo ZViewWidget::widget([
    'model' => $model,
    
]);
