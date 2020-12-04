<?php

use yii\helpers\ArrayHelper;
use kartik\builder\Form;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\system\kernels\ZView;
use zetsoft\system\Az;
use zetsoft\widgets\inputes\ZKSelect2Widget;
use zetsoft\widgets\incores\ZDepDropWidget;

$action->title = Azl . 'Веб-действия';

$action->icon = 'fa fa-database';
$action->debug = true;
$this->csrf = true;
$this->type = \zetsoft\system\kernels\WebItem::type['html'];
$action->debug = true;


$model = new \zetsoft\models\core\CoreInput();
/** @var ZView $this */

$items = Az::$app->forms->modelz->data();
$form = $this->activeBegin();
$this->modelSave($model);


echo ZFormWidget::widget([
    'model' => $model,
    'form' => $form,
    'rows' => [
        [
            'attributes' => [

                'int_1' => [
                    'type' => Form::INPUT_WIDGET,
                    'widgetClass' => ZKSelect2Widget::class,
                    'options' => [
                        'id' => 'module-id',
                        'data' => ArrayHelper::map(\zetsoft\models\page\PageModule::find()->all(), 'id', 'name'),
                        'options' => [
                            'placeholder' => 'Select...',
                        ],
                    ]
                ],
            ]
        ],

        [
            'attributes' => [

                'int_2' => [
                    'type' => Form::INPUT_WIDGET,
                    'widgetClass' => ZDepDropWidget::class,

                    'options' => [
                        'config' => [
                            'id' => 'control-id',
                            'depends' => ['module-id'],
                            'method' => 'ajax',
                            'args' =>  \zetsoft\models\page\PageControl::class.'|page_module_id',
                        ],

                        /*
                         * =&=getDrops&=run&
                         * */
                    ]
                ],
            ]
        ],

        [
            'attributes' => [

                'int_3' => [
                    'type' => Form::INPUT_WIDGET,
                    'widgetClass' => ZDepDropWidget::class,

                    'options' => [
                        'config' => [
                            'id' => 'action-id',
                            'depends' => ['control-id'],
                            'method' => 'ajax',
                            'args' => \zetsoft\models\page\PageAction::class.'|core_control_id',
                        ],
                    ]
                ],
            ]
        ],

        [
            'attributes' => [

                'int_4' => [
                    'type' => Form::INPUT_WIDGET,
                    'widgetClass' => ZDepDropWidget::className(),

                    'options' => [
                        'config' => [
                            'id' => 'attribute-id',
                            'depends' => ['control-id'],
                            'method' => 'ajax',
                            'args' =>  \zetsoft\models\page\PageAction::class,
                        ],
                    ],
                ],
            ]
        ],
    ],
]);


$this->activeEnd();
