<?php

use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\widgets\former\ZCheckSelectWidget;
use zetsoft\widgets\inputes\ZDropDownListWidget;
use zetsoft\widgets\inputes\ZKSelect2Widget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\former\ZCheckDependWidget;


$users = [];
$operators = Az::$app->market->operator->getUserByRole('agent');

$firstSelect = null;
if (!empty($operators)) {
    $firstSelect = $operators[0]['id'];

    foreach ($operators as $operator)
        $users[$operator['id']] = $operator['name'];

} else {
    echo '<span class="pl-3">' . Az::l("operators are not fount") . '</span>';
}

?>
<div class="col-md-12 d-flex ">
<div class="col-md-5">

<?php
echo ZCheckSelectWidget::widget([


    'config' => [
        'text' => 'Buttons',
        //'class' => 'simple-Report',
        'url' => ZUrl::to([
            '/api/core/app/check',
            'modelClassName' => $shopOrderItem->className,
        ]),
        'widgetClass' => ZDropDownListWidget::class,
        'widgetOptions' => [
            'data' => $users,
            'config' => [
                'class' => 'form-control d-block'
            ],

        ],
        'attr' => 'operator',
        'modelClassName' => $shopOrderItem->className,
        'btnOptions' => [
            'config' => [
                'text' => 'На исполнения',
                'btnStyle' => ZButtonWidget::btnStyle['btn-outline-success'],
                'btnSize' => ZButtonWidget::btnSize['btn-sm'],
                'btnRounded' => false,
            ]
        ]
    ]
]);

?>
</div>
<div class="col-md-7">

<?
echo ZCheckDependWidget::widget([

    'config' => [
        'attr' => 'status_callcenter',
        'value' => 'autodial',
        //'class' => 'simple-Report',
        'url' => ZUrl::to([
            '/api/core/dyna/check-new',
            'modelClassName' => $shopOrderItem->className,
        ]),
        'widgetClass' => ZDropDownListWidget::class,
        'widgetOptions' => [
            'data' => $users,
            'config' => [
                'class' => 'form-control d-block'
            ],
        ],

        'modelClassName' => $shopOrderItem->className,
        'btnOptions' => [
            'config' => [
                'text' => Az::l('автодозвон'),
                'btnStyle' => ZButtonWidget::btnStyle['btn-outline-success'],
                'btnType' => ZButtonWidget::btnType['submit'],
                'btnRounded' => false,
                'btnSize' => 'btn-sm',
                'class' => ''
            ]
        ]
    ]
]);
?>
</div>
</div>
