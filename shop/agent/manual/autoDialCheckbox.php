<?php

/**
 *
 *
 * Author: Xolmat Ravshanov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */
use kartik\editable\Editable;
use zetsoft\system\Az;
use zetsoft\widgets\former\ZEditKartikWidget;
use zetsoft\widgets\inputes\ZKSwitchInputWidget;
use zetsoft\widgets\inputes\ZMImageRadioGroupWidget;
         
$agentId = $this->userIdentity()->id;
$model   = $this->modelGet(\zetsoft\models\user\User::class , $agentId);

//$model   = $this->modelGet(\zetsoft\models\user\User::class ,126);

echo ZEditKartikWidget::widget([
    'model' => $model,
    'attribute' => 'autodial',
    'config' => [
        'inputType' => Editable::INPUT_WIDGET,
        'widgetClass' => ZKSwitchInputWidget::class,
        'emptyValueText' => Az::l('Режим оператора'),
        'format' => ZEditKartikWidget::format['link'],
        'placement' => ZEditKartikWidget::placement['ALIGN_AUTO_BOTTOM'],
        'asPopover' => true,
        'displayValueConfig' => [
            false  => Az::l('Автообзвон отключен'),
            true  => Az::l('Автообзвон включен'),
        ],
    ],
    'event' => [
           'editableSuccess' => 'function(event, val, form, data) {
                $.pjax.reload({container:"#pjax-id", timeout: false});
            }',
    ]

]);
