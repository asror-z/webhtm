<?php

use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\widgets\former\ZCheckDependWidget;
use zetsoft\widgets\former\ZDynaCheckWidget;
use zetsoft\widgets\inputes\ZDropDownListWidget;
use zetsoft\widgets\navigat\ZButtonWidget;

?>

<div class="col-md-4 mt-2 d-flex justify-content-around ">
    <?php
    echo ZDynaCheckWidget::widget([

        'config' => [
            'inputAttr' => 'operator',
            'attr' => 'status_callcenter',
            'value' => 'ring',
            //'class' => 'simple-Report',
            'url' => ZUrl::to([
                '/api/core/app/check-new',
                'modelClassName' => $model->className,
            ]),
            'widgetClass' => ZDropDownListWidget::class,
            'widgetOptions' => [
                'data' => $users,
                'id' => 'operator-dropdown',
                'config' => [
                    'class' => 'form-control d-block'
                ],
            ],

            'modelClassName' => $model->className,
            'btnOptions' => [
                'config' => [
                    'text' => Az::l('На исполнения'),
                    'btnType' => ZButtonWidget::btnType['button'],
                    'btnRounded' => false,
                    'btnStyle' => 'text-info',
                    'btnSize' => 'btn-ml',
                    'class' => 'p-1 pl-3 pr-3'
                ]
            ]
        ]
    ]);
    echo '<div class="col-3">' . ZCheckDependWidget::widget([

            'config' => [
                'attr' => 'status_callcenter',
                'value' => 'autodial',
                'dependId' => 'operator-dropdown',
                'dependAttr' => 'operator',
                'url' => ZUrl::to([
                    '/api/core/app/check-new',
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
                        'class' => 'p-1 pl-3 pr-3'
                    ]
                ]
            ]
        ]) . '</div>';
    ?>
</div>
