<?php

use zetsoft\dbitem\data\ALLApp;
use zetsoft\dbitem\data\Form;
use zetsoft\former\calls\CallsSortForm;
use zetsoft\former\calls\CallsStatsForm;
use zetsoft\models\shop\ShopOrder;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZCheckDependWidget;
use zetsoft\widgets\former\ZDynaCheckWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\former\ZFormWidgetA;
use zetsoft\widgets\inputes\ZDropDownListWidget;
use zetsoft\widgets\inputes\ZSelect2Widget;
use zetsoft\widgets\navigat\ZButtonWidget;


?>

<div class="row">

    <div class="col-md-6">

        <div class="d-flex">


            <?php
            /** @var ZView $this */
            $form = $this->ajaxBegin();

            $model = new ShopOrder();
            $users = [];
            $operators = Az::$app->market->operator->getUserByRole('agent');


            $firstSelect = null;
            if (!empty($operators)) {
                $firstSelect = $operators[0]['id'];

                foreach ($operators as $operator)
                    $users[$operator['id']] = $operator['title'];

            } else {
                echo '<span class="pl-3">' . Az::l("operators are not fount") . '</span>';
            }

            $formModel = new CallsSortForm;
            $formModel->configs->hasLabel = false;

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
                                              
                                  
                                        function() {
        
                                                $.ajax({
                                                    type: 'POST',
                                                    url: '/core/product/rangeClear.aspx',
           
                                                    success: function (response) {
                                                        location.reload();
                                                    },
                                                });
                                            
                                        }
        JS
                    ],
                ]);
                $this->ajaxEnd(); ?>


            </div>


        </div>


    </div>


    <div class="col-md-3  offset-2">

        <div class="d-flex">

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
                                'class' => 'p-1'
                            ]
                        ]
                    ],
                    'event' => [
                        'ajaxComplete' => <<<JS
   function () {
           location.reload()
   }
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
                                'class' => 'p-1'
                            ]
                        ]
                    ],
                    'event' => [
                        'ajaxComplete' => <<<JS
   function () {
             location.reload()
   }
JS,
]
]) . '</div>';
            ?>

      </div>
</div>
</div>


<!--<div class="d-flex flex-wrap">



    <div class="d-flex">




    </div>
</div>-->
<style>
    #zdynamicmodel-period {
        display: grid;
        padding-top: 4px;
        border-radius: 4px;
    }

    .form-group {
        margin-bottom: 0 !important;
    }

    .period_picker_input{
        margin-top: 5px!important;
        /*margin-right: 10em!important;*/
    }
    .select2-container{
        margin-top: 5px!important;
    }
    .period_picker_input:before{
        width: border-box!important;
    }
</style>

