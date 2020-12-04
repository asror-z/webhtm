<?php

use zetsoft\former\calls\CallsSortForm;
use zetsoft\models\shop\ShopOrder;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZCheckDependWidget;
use zetsoft\widgets\former\ZDynaCheckWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\inputes\ZDropDownListWidget;
use zetsoft\widgets\inputes\ZSelect2Widget;
use zetsoft\widgets\navigat\ZButtonWidget;


?>

<!-- start|FozilZayniddinov|10/15/2020 -->

<div class="row">
    <div class="col-md-12 d-flex justify-content-between">
        <div class="col-md-6">
            <div class="d-flex">
            
<!-- end|FozilZayniddinov|10/15/2020 -->

                <?php

                /** @var ZView $this */

                $form = $this->ajaxBegin();

                $model = new ShopOrder();
                
                $users = [];

                $operators = Az::$app->market->operator->getUserByRole('agent');


                $firstSelect = null;

                if (!empty($operators)) {
                    $firstSelect = $operators[0]['id'];

                    foreach ($operators as $operator) {
                        $users[$operator['id']] = $operator['title'];
                    }

                } else {
                    echo '<span class="pl-3">' . Az::l('operators are not fount') . '</span>';
                }

                $formModel = new CallsSortForm;

               $value = ZArrayHelper::getValue($this->sessionGet('supervisorRangeDatePeriod2'), 'start');


                 /* $value = [
                      0 => "00:00 2016/12/1",
                      1 => "00:00 2017/01/29",
                  ];*/

                $formModel->configs->options = [
                        'start' => [
                            'value' => $value ?? null,
                            'config' => [
                                'timepicker' => true,
                            ],
                        ],
                ];


                $formModel->configs->hasLabel = false;
                $formModel->columns();

//                vdd($formModel->columns['start']->options);
                ?>

                <div class="d-flex">

                    <?

                    echo ZFormBuildWidget::widget([
                        'model' => $formModel,
                        'form' => $form,
                        'config' => [
                            'topBtn' => false,
                            'botBtn' => false,
                        ],
                    ]);

                    ?>


                    <?php

                    echo ZButtonWidget::widget([
                        'config' => [
                            'text' => Az::l('Фильтровать'),
                            'btnType' => ZButtonWidget::btnType['submit'],
                            'btnRounded' => false,
                            'btnStyle' => 'text-success',
                            'btnSize' => 'btn-ml',
                            'class' => 'p-1',

                        ]
                    ]);

                    echo ZButtonWidget::widget([
                        'config' => [
                            'text' => Az::l('Очистить фильтр'),
                            'btnType' => ZButtonWidget::btnType['button'],
                            'btnRounded' => false,
                            'btnStyle' => 'text-info',
                            'btnSize' => 'btn-ml',
                            'class' => 'p-1',
                        ],
                        'event' => [
                            'click' => <<<JS
                          $.ajax({
                           type: 'POST',
                           url: '/core/product/rangeClear.aspx',
                           success: function (response) {
                            location.reload();                                                        
                },
    });
                                                
                                            
    JS
                        ],
                    ]);

                    $this->ajaxEnd();
                    ?>


                </div>


            </div>

        </div>
        <!-- start|FozilZayniddinov|10/15/2020 -->
        <div class="col-md-6 ml-auto">
            <div class="d-flex justify-content-end">
        <!-- end|FozilZayniddinov|10/15/2020 -->
                <?php

            echo '<div class="ml-2">' . ZDynaCheckWidget::widget([

                    'config' => [
                        'inputAttr' => 'operator',
                        'attr' => 'status_callcenter',
                        'value' => 'ring',
                        'url' => ZUrl::to([
                            '/api/core/dyna/check-new',
                            'modelClassName' => $model->className,
                        ]),
                        'widgetClass' => ZSelect2Widget::class,
                        'widgetOptions' => [
                            'data' => $users,
                            'id' => 'operator-dropdown',
                            'config' => [
                                'class' => 'form-control d-block',
                                'placeholder' => 'выберите оператора',
                                'ajax' => false,
                            ],
                        ],

                        'modelClassName' => $model->className,
                        'btnOptions' => [
                            'config' => [
                                'text' => Az::l('Новый'),
                                'btnType' => ZButtonWidget::btnType['button'],
                                'btnRounded' => false,
                                'btnStyle' => 'text-info',
                                'btnSize' => 'btn-ml',
                                'class' => 'p-1 px-2'
                            ]
                        ]
                    ],
                    'event' => [
                        'ajaxComplete' => <<<JS
                               location.reload()
JS,

                    ]
                ]) . '</div>';
            echo '<div class="ml-5">' . ZCheckDependWidget::widget([

                    'config' => [
                        'attr' => 'status_callcenter',
                        'value' => 'autodial',
                        'dependId' => 'operator-dropdown',
                        'dependAttr' => 'operator',
                        'url' => ZUrl::to([
                            '/api/core/dyna/check-new',
                            'modelClassName' => $model->className,
                        ]),
                        'widgetClass' => ZDropDownListWidget::class,
                        'widgetOptions' => [
                            'data' => $users,
                            'config' => [
                                'class' => 'form-control w-25'
                            ],
                        ],

                        'modelClassName' => $model->className,
                        'btnOptions' => [
                            'config' => [
                                'text' => Az::l('Автообзвон'),
                                'btnType' => ZButtonWidget::btnType['button'],
                                'btnRounded' => false,
                                'btnStyle' => 'text-success',
                                'btnSize' => 'btn-ml',
                                'class' => 'p-1 ml-3'
                            ]
                        ]
                    ],
                    'event' => [
                        'ajaxComplete' => <<<JS
                               location.reload()
JS,
                    ]
                ]) . '</div>';
            ?>
            </div>

        </div>
    </div>
</div>

<style>

    #zdynamicmodel-period {
        display: grid;
        padding-top: 4px;
        border-radius: 4px;
    }
    .form-group {
        /* start|FozilZayniddinov|10/15/2020 */
        margin-bottom: 0 !important;
        /* end|FozilZayniddinov|10/15/2020 */
    }

    .period_picker_input {
        /* start|FozilZayniddinov|10/15/2020 */
        margin-top: 10px !important;
        /* end|FozilZayniddinov|10/15/2020 */
    }

    .select2-container {
        margin-top: 0px !important;
    }

    .period_picker_input:before {
        width: border-box !important;
    }
</style>

