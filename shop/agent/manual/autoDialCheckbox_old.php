<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

use zetsoft\system\Az;
use zetsoft\widgets\former\ZEditKartikWidget;
use zetsoft\widgets\inputes\ZKSwitchInputWidget;


$modelNew = $this->modelGet(\zetsoft\models\user\User::class ,124);


echo ZEditKartikWidget::widget([
    'name' => 'currency',
    'attribute' => 'autodial',
    'model' => $modelNew,
    'config' => [
        'widgetClass' => ZKSwitchInputWidget::class,
        'emptyValueText' => Az::l('Режим оператора'),
        'text-color' =>'text-muted',
        'asPopover' => true,
        'displayValueConfig' => [
             false  => Az::l('Автообзвон отключен'),
             true  => Az::l('Автообзвон включен'),
        ]
    ],

    'event' => [
        'editableAjaxSuccess' => <<<JS
            location.reload()
JS,
    ]

]);
