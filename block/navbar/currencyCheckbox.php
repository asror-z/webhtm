<?php
/**
 * @author: AzimjonToirov
 *
 */

use zetsoft\models\shop\ShopCatalog;
use zetsoft\models\shop\ShopOrderCopy;
use zetsoft\system\Az;
use zetsoft\widgets\former\ZEditRavWidget;
use zetsoft\widgets\inputes\ZCurrencyRadioWidget;

$core_catalog = new ShopCatalog();

echo ZEditRavWidget::widget([
    'name' => 'currency',
    'config' => [
        'session' => true,
        'widgetClass' => ZCurrencyRadioWidget::class,
        'emptyValueText' => Az::l('Выберите валюту'),
        'text-color' =>'text-muted',
        'options' => [
            'data' => $core_catalog->_currency,
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
