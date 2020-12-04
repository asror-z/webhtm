<?php


use kartik\builder\Form;
use rmrevin\yii\fontawesome\FA;
use zetsoft\models\core\CoreInput;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\inputes\ZPeriodPickerWidget;

$model = $this->modelGet(CoreInput::class, 4);
/** @var ZView $this */

$items = $this->modelData();
$form = $this->activeBegin();
$this->modelSave($model);


echo ZFormWidget::widget([
    'model' => $model,
    'form' => $form,
    'rows' => [
        [
            'attributes' => [
                'jsonb_3' => [
                    'type' => Form::INPUT_WIDGET,
                    'widgetClass' => \zetsoft\widgets\former\ZJqueryScriptDatePickerWidget::class,
                    'options' => [
                    ]
                ],
            ]

        ],

    ]
]);


$this->activeEnd();

