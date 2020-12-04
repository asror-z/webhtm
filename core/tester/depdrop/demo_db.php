<?php

use kartik\depdrop\DepDrop;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use zetsoft\models\page\PageAction;
use zetsoft\models\user\User;

$action->title = Azl . 'Веб-действия';

$action->icon = 'fa fa-database';
$action->debug = true;
$this->csrf = true;
$this->type = \zetsoft\system\kernels\WebItem::type['html'];


$action->debug = true;
$model = new \zetsoft\models\core\CoreInput();
$form = ActiveForm::begin();


// Parent
echo $form->field($model, 'int_1')->dropDownList(
    ArrayHelper::map(\zetsoft\models\page\PageModule::find()->all(), 'id', 'name'),
    ['id' => 'module-id']
);

// Child level 1

echo $form->field($model, 'int_2')->widget(DepDrop::classname(), [
    'options' => [
        'id' => 'control-id'
    ],
    'type' => DepDrop::TYPE_SELECT2,
    'select2Options' => [
        'pluginOptions' => [
            'placeholder' => 'Select...',
            'allowClear' => true,
        ]
    ],
    'pluginOptions' => [
        'depends' => ['module-id'],
        'initialize' => false,
        'url' => Url::to(['depdropret/ajax'])
    ]
]);

// Child level 2
echo $form->field($model, 'int_3')->widget(DepDrop::classname(), [
    'options' => [
        'id' => 'action-id'
    ],
    'type' => DepDrop::TYPE_SELECT2,
    'select2Options' => [
        'pluginOptions' => [
            'placeholder' => 'Select...',
            'allowClear' => true,
        ]
    ],
    'pluginOptions' => [
        'depends' => ['control-id'],
        'initialize' => false,
        'url' => Url::to(['depdropret/ajax1'])
    ]
]);

// Child level 3
echo $form->field($model, 'int_4')->widget(DepDrop::classname(), [
    'options' => [
        'id' => 'attribute-id'
    ],
    'type' => DepDrop::TYPE_SELECT2,
    'select2Options' => [
        'pluginOptions' => [
            'placeholder' => 'Select...',
            'allowClear' => true,
        ]
    ],
    'pluginOptions' => [
        'depends' => ['control-id'],
        'initialize' => false,
        'url' => Url::to(['depdropret/ajax2'])
    ]
]);

ActiveForm::end();
