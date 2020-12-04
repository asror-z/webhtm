<?php

use kartik\builder\Form;
use kartik\grid\DataColumn;
use yii\helpers\Html;
use zetsoft\models\user\UserCompany;
use zetsoft\models\user\User;
use zetsoft\system\column\ZKEditableColumn;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\widgets\former\ZDynaWidgetR;
use zetsoft\widgets\inputes\ZKSelect2Widget;

$models = new User();
$columns =
    [
        [
            'class' => ZKDataColumn::class,
            'attribute' => 'password',
        ],
        [
            'class' => ZKEditableColumn::class,
            'attribute' => 'name',
            'value' => function ($model, $key, $index, $column) {
                return $model->name;
            },
            'filterType' => ZKSelect2Widget::class,
            'filterWidgetOptions' => [
                'data' => ZArrayHelper::map(UserCompany::find()->all(), 'name', 'name'),
                'config' => [
                    'multiple' => true
                ]
            ]
        ],
        [
            'class' => ZKDataColumn::class,
            'attribute' => 'email',
        ],
    ];

echo ZDynaWidgetR::widget([

    'columns' => $columns,

    'config' => [
        'theme' => 'panel-danger',
    ]
]);
