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


$catList = [
    1 => 'Electronics',
    2 => 'Books',
    3 => 'Home & Kitchen'
];

$action->debug = true;
$model = new \zetsoft\models\core\CoreInput();
$form = ActiveForm::begin();


// Parent
echo $form->field($model, 'int_1')
->dropDownList($catList, ['id'=>'cat-id']);

// Child level 1

echo $form->field($model, 'int_2')->widget(DepDrop::classname(), [
    'options'=>[
        'id'=>'subcat-id-2'
    ],
    'pluginOptions'=>[
        'depends'=>['cat-id'],
        'placeholder'=>'Select...',
        'url'=>Url::to(['depdropreturn/ajax'])
    ]
]);

// Child level 2
echo $form->field($model, 'int_3')->widget(DepDrop::classname(), [
    'options'=>[
        'id'=>'subcat-id-3'
    ],
    'pluginOptions'=>[
        'depends'=>['subcat-id-2'],
        'placeholder'=>'Select...',
        'url'=>Url::to(['depdropreturn/ajax'])
    ]
]);

// Child level 3
echo $form->field($model, 'int_4')->widget(DepDrop::classname(), [
    'options'=>[
        'id'=>'subcat-id-4'
    ],
    'pluginOptions'=>[
        'depends'=>['subcat-id-3'],
        'placeholder'=>'Select...',
        'url'=>Url::to(['depdropreturn/ajax'])
    ]
]);

ActiveForm::end();
