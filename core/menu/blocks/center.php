<?php

use kartik\form\ActiveForm;
use rmrevin\yii\fontawesome\FA;
use zetsoft\models\page\PageView;
use zetsoft\system\Az;
use zetsoft\widgets\incores\ZMCheckboxWidget;
use zetsoft\widgets\inputes\ZInputWidget;
use zetsoft\widgets\inputes\ZKSelect2Widget;
use zetsoft\widgets\navigat\ZButtonWidget;

?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 section-1">
            <div class="card ">
                <div class="card-header text-white d-flex"><i class="fas fa-chart-pie"></i>
                    <h5>
                        Меню "<?= $model->name ?>" <?= $model->title ?>
                    </h5>
                </div>

                <div class="card-body section-2">
                    <ul id="myEditor" class="sortableLists list-group">

                    </ul>
                </div>
            </div>

            <button id="btnOutput" class="btn-1 btn btnOutes"></button>

        </div>

        <div class="col-md-6 section-2">

            <div class="card">

                <div class="card-header text-white d-flex">
                    <i class="fas fa-chart-pie"></i>
                    <h5>Изменить элемент</h5>
                </div>

                <div class="card-body">

                    <?php $form = ActiveForm::begin(['id' => 'formEdit']) ?>

                    <div class="form-group section-6">

                        <div class="d-flex align-items-center w-100">

                            <input type="hidden" class="item-menu" id="action" name="action">

                            <?php
                            echo ZButtonWidget::widget([
                                'id' => 'ac_btn',
                                'config' => [
                                    'btnType' => ZButtonWidget::btnType['button'],
                                    'btnStyle' => ZButtonWidget::btnStyle['btn-primary'],
                                   /* 'btnSize' => ZButtonWidget::btnSize['btn-sm'],*/
                                    'btnRounded' => true,
                                    'hasIcon' => true,
                                    'icon' => 'far fa-' . FA::_COPY,
                                ]
                            ]);
                            ?>

                            <div class="d-flex align-items-center w-50">
                                <div class="col-md-12">
                                    <?php
                                    echo ZKSelect2Widget::widget([
                                        'id' => 'vall',
                                        'data' => $action,
                                        'name' => 'action',
                                        'config' => [
                                            'multiple' => false,
                                            'ajax' => false,
                                            'class' => '',
                                            'placeholder' => Az::l('Веб действия')
                                        ],
                                        'active' => [
                                            'select' => true
                                         ],
                                        'event' => [
                                            'select' => <<<JS
      
        
         $('#text_vall').val($('#vall').val()).trigger("change");
        $('#ico').removeClass();
        $('#ico').addClass(icons[$('#vall').val()]);
        $('#icon_value').val(icons[$('#vall').val()]);
      

JS,
                                        ]

                                    ]);
                                    ?>

                                </div>

                            </div>

                            <div class="d-flex align-items-center w-25 ml-4">
                                <div class="form-group">
                                    <label for="args"></label>
                                    <input type="hidden" name="args" id="args_val">
                                </div>
                                <i class="fas fa-cubes iconn params"></i>
                                <?php
                                echo ZInputWidget::widget([
                                    'id' => 'params',
                                    'name' => 'params',
                                    'config' => [
                                        'class' => 'item-menu inputMenu w-100',
                                        'placeholder' => Az::l('Параметр')
                                    ]
                                ]);
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">

                        <div class="d-flex align-items-center w-100">
                            <!--start:TursunaliyevAbdulloh-->
                            <input type="hidden" id="text_value" class="item-menu" name="text">
                            <!--end:TursunaliyevAbdulloh-->
                            <?php
                            echo ZButtonWidget::widget([
                                'id' => 'bta',
                                'config' => [
                                    'btnType' => ZButtonWidget::btnType['button'],
                                    'btnStyle' => ZButtonWidget::btnStyle['btn-primary'],
                                   /* 'btnSize' => ZButtonWidget::btnSize['btn-sm'],*/
                                    'btnRounded' => true,
                                    'hasIcon' => true,
                                    'icon' => 'far fa-' . FA::_COPY,
                                ]
                            ]);
                            ?>

                            <div class="d-flex align-items-center w-50">

                                <div class="col-md-12">

                                    <?php

                                    echo ZKSelect2Widget::widget([
                                        'id' => 'text_vall',
                                        'name' => 'title',
                                        'data' => $titles,
                                        'config' => [
                                            'multiple' => false,
                                            'class' => '',
                                            'ajax' => false,
                                            'placeholder' => Az::l('Текст')
                                        ],
                                        'active' => [
                                            'select' => true
                                        ],
                                        'event' => [
                                            'select' => <<<JS
                               
                 $('#vall').val($('#text_vall').val()).trigger('change');
                $('#ico').removeClass();
                $('#ico').addClass(icons[$('#text_vall').val()]);
                $('#icon_value').val(icons[$('#text_vall').val()]);
                              
JS,
                                        ]
                                    ]);
                                    ?>

                                </div>

                            </div>

                            <div class="d-flex align-items-center w-25 ml-4">

                                <span class="iconn"><i id="ico" class="fab fa-font-awesome iconn wrift"></i></span>

                                <?php
                                echo ZInputWidget::widget([
                                    'id' => 'icon_value',
                                    'name' => 'icon',
                                    'config' => [
                                        'class' => 'item-menu inputMenu w-100',
                                        'readonly' => true,
                                        'placeholder' => Az::l('Иконка')
                                    ],

                                ]);
                                ?>

                            </div>
                        </div>
                    </div>

                    <div class="form-group d-flex ml-2 marg">

                        <div class="input-group">

                            <div class="d-flex w-100">
                                <i class="fas fa-bullseye iconn target"></i>

                                <div class="d-flex w-100 ml-2">

                                    <div class="col-md-12">

                                        <?php
                                        $dataTarget = [
                                            '_self' => '_self',
                                            '_blank' => '_blank',
                                            '_top' => '_top',

                                        ];
                                        echo ZKSelect2Widget::widget([
                                            'id' => 'targetValue',
                                            'data' => $dataTarget,
                                            'name' => 'target',
                                            'config' => [
                                                'multiple' => false,
                                                'class' => 'select-4 item-menu',
                                                'placeholder' => Az::l('Веб цель'),
                                                'ajax' => false
                                            ],

                                        ]);
                                        ?>

                                    </div>

                                </div>

                                <div class="d-flex w-25 Editorcheckbox">
                                    <?php
                                    echo ZMCheckboxWidget::widget([
                                        'name' => 'active',
                                        'id' => 'active',
                                        'config' => [
                                            'placeholder' => Az::l('Активен'),
                                            'class' => 'item-menu chek',
                                        ],
                                        'event' => [
                                            'click' => <<<JS
                             function() {
                    if($(this).val() === 'true'){
                        $(this).val(false).removeAttr('checked');

                    }
                    else{
                        $(this).val(true).attr('checked', '1');
                    }
         }
JS,
                                        ]
                                    ]);
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group d-flex ml-1 section-3 align-items-center justify-content-start w-100">

                        <i class="fab fa-css3-alt icon_css"></i>

                        <div class="col-md-10">
                            <?php

                            echo ZKSelect2Widget::widget([
                                'id' => 'SelectOption',
                                'name' => 'class',
                                'data' => [
                                    'btn' => 'btn',
                                    'mt' => 'mt',
                                    'mt-2' => 'mt-2',
                                    'mt-3' => 'mt-3',
                                    'btn-lg' => 'btn-lg',
                                    'btn-sm' => 'btn-sm',
                                    'btn-primary' => 'btn-primary',
                                    'btn-success' => 'btn-success',
                                    'btn-danger' => 'btn-danger',
                                    'btn-warning' => 'btn-warning',
                                    'btn-info' => 'btn-info',
                                    'btn-dark' => 'btn-dark'
                                ],
                                'config' => [
                                    'multiple' => true,
                                    'class' => 'item-menu',
                                    'placeholder' => Az::l('Выбрать Css класс'),
                                    'ajax' => false
                                ]
                            ]);
                            ?>
                        </div>
                    </div>
                    <div class="form-group d-flex ml-2 section-3 align-items-center justify-content-start w-100">

                        <i class="fas fa-eye iconn roleUser"></i>

                        <div class="col-md-10">
                            <?
                            echo ZKSelect2Widget::widget([
                                'id' => 'RoleValue',
                                'data' => $roles,
                                'name' => 'role',
                                'config' => [
                                    'multiple' => true,
                                    'class' => 'item-menu',
                                    'placeholder' => Az::l('Доступ запрешён для ..'),
                                    'ajax' => false
                                ]
                            ]);
                            ?>
                        </div>
                    </div>
                    <? ActiveForm::end() ?>
                </div>

                <div class="card-footer d-flex col-lg-12 section-4 col-md-6">

                    <div class="btn-group btnUpdates">
                        <?php
                        echo ZButtonWidget::widget([
                            'id' => 'btnUpdate',
                            'config' => [
                                'toggle'=>'',
                                'hasIcon' => true,
                                'btnRounded' => false,
                                'title' => 'Обновить',
                                'icon' => 'ft fas fa-' . FA::_SYNC_ALT,
                                'btnType' => ZButtonWidget::btnType['button'],
                                'btnStyle' => ZButtonWidget::btnStyle['btn-outline-success'],
                            ],


                        ]);

                        $form = ActiveForm::begin(['id' => 'menuform']);
                        
                        echo $form->field($model, 'json')->hiddenInput([
                            'value' => $json
                        ])->label(false);

                        echo ZButtonWidget::widget([
                            'id' => 'valueIc',
                            'config' => [
                                'toggle'=>'',
                                'hasIcon' => true,
                                'class' => 'submitBtn',
                                'title' => 'Сохранить',
                                'icon' => 'ft fas fa-' . FA::_SAVE,
                                'btnType' => ZButtonWidget::btnType['submit'],
                                'btnStyle' => ZButtonWidget::btnStyle['btn-outline-primary'],
                                'btnRounded' => false,
                            ]
                        ]);

                        ActiveForm::end();
                        echo ZButtonWidget::widget([
                            'id' => 'btnAdd',
                            'config' => [
                                'toggle'=>'',
                                'hasIcon' => true,
                                'title' => 'Добавить',
                                'icon' => 'ft fas fa-' . FA::_PLUS,
                                'btnType' => ZButtonWidget::btnType['button'],
                                'btnStyle' => ZButtonWidget::btnStyle['btn-outline-dark'],
                                'btnRounded' => false
                            ],

                        ]);
                        ?>
                    </div>

                    <div class="ml-auto">
                        <div class="btn-group">

                            <?php
                            echo ZButtonWidget::widget([
                                'id' => 'delMen',
                                'config' => [
                                    'toggle'=> '',
                                    'hasIcon' => true,
                                    'title' => 'Удалить меню',
                                    'icon' => 'ft fas fa-' . FA::_TRASH_ALT,
                                    'btnType' => ZButtonWidget::btnType['button'],
                                    'btnStyle' => ZButtonWidget::btnStyle['btn-outline-danger'],
                                    'btnRounded' => false,
                                ],
                                'event' =>[
                                    'click'=><<<JS
                                function () {
                                    var myEditor = $('#myEditor');
                                    myEditor.empty();
                                }
JS,
                                ]
                            ]);

                            echo ZButtonWidget::widget([
                                'id' => 'setDat',
                                'config' => [
                                    'toggle'=>'',
                                    'hasIcon' => true,
                                    'title' => 'Примерное меню',
                                    'icon' => 'ft fas fa-' . FA::_CODE,
                                    'btnType' =>  ZButtonWidget::btnType['button'],
                                    'btnStyle' => ZButtonWidget::btnStyle['btn-outline-primary'],
                                    'btnRounded' => false
                                ]
                            ]);
                            ?>
                        </div>
                    </div>
                </div>

                <div id="out" class="form-group section-5 shadow-textare">
                    <textarea  class="form-control z-depth-512 min-tx-heigth" hidden cols="1" rows="2"></textarea>
                </div>
            </div>
        </div>
    </div>
</div>
