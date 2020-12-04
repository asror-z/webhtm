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

use kartik\detail\DetailView;
use zetsoft\models\App\eyuf\EyufDocumentType;
use zetsoft\widgets\former\ZDetailWidget;
use zetsoft\widgets\former\ZViewWidget;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZFormWizardWidget;
use yii\bootstrap4\Modal;
/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Просмотр  Типы Документов';
$action->icon = 'fa fa-cloud-download';

$id = $this->httpGet('id');
$model = EyufDocumentType::findOne(376);

echo ZDetailWidget::widget([
    'model' => $model,
    'config' => [
        'condensed' => true,
        'hover' => true,
        'mode' => DetailView::MODE_VIEW,
        'panel' => [
            'headingOptions' => 'Book # ' . $model->name,
            'type' => DetailView::TYPE_INFO,
        ],
        'attributes' => [
            'id',
            'name',

        ]
    ]
]);



