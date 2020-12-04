<?php

use kartik\depdrop\DepDrop;
use zetsoft\dbdata\eyuf\DepDropData;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use zetsoft\models\page\PageAction;
use zetsoft\models\user\User;
use kartik\builder\Form;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\system\kernels\ZView;
use zetsoft\system\Az;
use zetsoft\widgets\inputes\ZKSelect2Widget;

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
                    'widgetClass' => DepDrop::class,

                    'options' => [
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
                            'url' => Url::to([
                                'service',
                                'namespace' => 'inputs',
                                'service' => 'depDrops',
                                'method' => 'ajax',
                                'args' => \zetsoft\models\page\PageControl::class.'|page_module_id',
                            ])
                        ]

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
                    'widgetClass' => DepDrop::class,

                    'options' => [

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
                            'url' => Url::to([
                                'service',
                                'namespace' => 'inputs',
                                'service' => 'depDrops',
                                'method' => 'ajax',
                                'args' => PageAction::class.'|core_control_id',
                            ])

                        ]

                    ]
                ],
            ]
        ],

        [
            'attributes' => [

                'int_4' => [
                    'type' => Form::INPUT_WIDGET,
                    'widgetClass' => DepDrop::className(),

                    'options' => [

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
                            'url' => Url::to([
                                'service',
                                'namespace' => 'inputs',
                                'service' => 'depDrops',
                                'method' => 'ajax',
                                'args' => [
                                    'model' => PageAction::class,
                                ]
                            ])
                        ]

                    ]
                ],
            ]
        ],
    ],
]);


$this->activeEnd();
