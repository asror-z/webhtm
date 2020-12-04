<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */
 
use zetsoft\models\faqs\FaqsManual;
use zetsoft\widgets\former\ZViewWidget;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZFormWizardWidget;

/** @var ZView $this */


$action->title = Azl . 'Просмотр  Справочник';
$action->icon = 'fa fa-area-chart';
$action->debug = true;
$action->type = WebItem::type['ajax'];

$id = $this->httpGet('id');
$model = FaqsManual::findOne($id);

echo ZViewWidget::widget([
    'model' => $model,
    
]);
