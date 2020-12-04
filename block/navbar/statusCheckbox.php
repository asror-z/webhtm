<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

use zetsoft\models\shop\ShopCatalog;
use zetsoft\system\Az;
use zetsoft\widgets\former\ZEditRavWidget;
use zetsoft\widgets\former\ZEditRavWidgetD;
use zetsoft\widgets\inputes\ZCurrencyRadioWidget;

$modelNew = $this->modelGet(\zetsoft\models\user\User::class, 116);

echo ZEditRavWidget::widget([
    'name' => 'manual',
    'config' => [
        'session' => true,
        'widgetClass' => ZCurrencyRadioWidget::class,
        'emptyValueText' => Az::l('Режим оператора'),
        'text-color' => 'text-muted',
        'options' => [
            'data' => $modelNew->_status,
            'config' => [
                'url' => ZCurrencyRadioWidget::imageUrl['checkbox'],
                'checkMarkPosition' => ZCurrencyRadioWidget::checkMarkPosition['top-right'],
                'checkMarkSize' => '14px',
            ]
        ]
    ],
    'event' => [
        'editableAjaxSuccess' => <<<JS
            location.reload()
JS,
    ]
]);
