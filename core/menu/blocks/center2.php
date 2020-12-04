<?php

use kartik\form\ActiveForm;
use rmrevin\yii\fontawesome\FA;
use zetsoft\former\menu\MenuEditorForm;
use zetsoft\service\forms\Active;
use zetsoft\system\Az;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\themes\ZCardWidget;


?>

<div class="container-fluid">

    <div class="row">

        <div class="col-md-6">

            <?
            ZCardWidget::begin([
                'config' => [
                    'title' => Az::l('Визуальное Меню'),
                    'type' => ZCardWidget::type['null'],
                ]
            ]);
            ?>

            <div class="card-body section-2">
                <ul id="myEditor" class="sortableLists list-group">

                </ul>
            </div>

            <? ZCardWidget::end(); ?>

        </div>

        <div class="col-md-6">
            <?
            $form = ActiveForm::begin(['id' => 'menuform']);

            echo $form->field($model, 'json')->hiddenInput([
                'value' => $json
            ])->label(false);

            ActiveForm::end();

            ZCardWidget::begin([
                'config' => [
                    'title' => Az::l('Настройка Меню'),
                    'type' => ZCardWidget::type['null'],
                ]
            ]);

            $active = new Active();
            $active->type = Active::type['vertical'];
            $form = $this->activeBegin($active);

            $model = new MenuEditorForm();
            
            $model->cards = [
                [
                    'title' => Az::l('Первый этап'),
                    'items' => [
                        [
                            'title' => Az::l('Форма'),
                            'items' => [
                                [
                                    'action',
                                    'text',
                                    'icon',
                                ],
                                [
                                    'param',
                                    'target',
                                ],
                                [
                                    'cssClass',
                                    'active',
                                ],
                            ],
                        ],
                    ],
                ]
            ];
            $model->columns();

            echo ZFormBuildWidget::widget([
                'model' => $model,
                'form' => $form,
                'config' => [
                    'topBtn' => false,
                    'botBtn' => false,
                    'isStepsVertical' => false,
                    'stepType' => ZFormBuildWidget::stepType['none'],
                    'blockType' => ZFormBuildWidget::blockType['naked'],
                ],
            ]);
            ?>
            <div class="row">
                <?
                echo ZButtonWidget::widget([
                    'id' => 'btnUpdate',
                    'config' => [
                        'toggle' => '',
                        'hasIcon' => true,
                        'btnRounded' => false,
                        'title' => 'Обновить',
                        'icon' => 'ft fas fa-' . FA::_SYNC_ALT,
                        'btnType' => ZButtonWidget::btnType['button'],
                        'btnStyle' => ZButtonWidget::btnStyle['btn-outline-success'],
                    ],


                ]);

                echo ZButtonWidget::widget([
                    'id' => 'valueIc',
                    'config' => [
                        'toggle' => '',
                        'hasIcon' => true,
                        'class' => 'submitBtn',
                        'title' => 'Сохранить',
                        'icon' => 'ft fas fa-' . FA::_SAVE,
                        'btnType' => ZButtonWidget::btnType['submit'],
                        'btnStyle' => ZButtonWidget::btnStyle['btn-outline-primary'],
                        'btnRounded' => false,
                    ]
                ]);

                echo ZButtonWidget::widget([
                    'id' => 'btnAdd',
                    'config' => [
                        'toggle' => '',
                        'hasIcon' => true,
                        'title' => 'Добавить',
                        'icon' => 'ft fas fa-' . FA::_PLUS,
                        'btnType' => ZButtonWidget::btnType['button'],
                        'btnStyle' => ZButtonWidget::btnStyle['btn-outline-dark'],
                        'btnRounded' => false
                    ],

                ]);

                echo ZButtonWidget::widget([
                    'id' => 'delMen',
                    'config' => [
                        'toggle' => '',
                        'hasIcon' => true,
                        'title' => 'Удалить меню',
                        'icon' => 'ft fas fa-' . FA::_TRASH_ALT,
                        'btnType' => ZButtonWidget::btnType['button'],
                        'btnStyle' => ZButtonWidget::btnStyle['btn-outline-danger'],
                        'btnRounded' => false
                    ],
                    'event' => [
                        'click' => <<<JS
                                function () {
                                    var myEditor = $('#myEditor');
                                    myEditor.empty();
                                }
JS,
                    ],
                ]);

                echo ZButtonWidget::widget([
                    'id' => 'setDat',
                    'config' => [
                        'toggle' => '',
                        'hasIcon' => true,
                        'title' => 'Примерное меню',
                        'icon' => 'ft fas fa-' . FA::_CODE,
                        'btnType' => ZButtonWidget::btnType['button'],
                        'btnStyle' => ZButtonWidget::btnStyle['btn-outline-primary'],
                        'btnRounded' => false,
                    ]
                ]);
                ?>
            </div>
            <?

            $this->activeEnd();
            ZCardWidget::end();
            ?>
        </div>

    </div>


</div>
