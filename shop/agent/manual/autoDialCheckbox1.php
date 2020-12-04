<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

use kartik\editable\Editable;
use zetsoft\widgets\former\ZEditKartikWidget;
use zetsoft\widgets\inputes\ZImageCheckboxWidget;
use zetsoft\widgets\inputes\ZImgRadioWidget;


$model   = $this->modelGet(\zetsoft\models\user\User::class ,124);
   
    echo ZEditKartikWidget::widget([
        'model' => $model,
        'attribute' => 'status',
        'config' => [
            'inputType' => Editable::INPUT_WIDGET,
            'widgetClass' => ZImgRadioWidget::class,
            'format' => ZEditKartikWidget::format['button'],
            'asPopover' => true
        ]
        //'editableValueOptions'=>['class'=>'text-success h2']
    ]);

?>
