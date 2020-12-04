<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

use kartik\detail\DetailView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use zetsoft\system\Az;

Az::$app->controller->layout = 'login';

$this->title = 'View Book'; // $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Books', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

// setup your attributes
$attributes = [
    [
        'attribute' => 'book_code',
        'format' => 'raw',
        'value' => '<kbd>' . $scholar->book_code . '</kbd>',
        'displayOnly' => true
    ],
    'attribute' => 'book_name',
    [
        'attribute' => 'color',
        'format' => 'raw',
        'value' => Html::tag('span', ' ', [
                'class' => 'badge',
                'style' => 'background-color' . $scholar->color,
            ]) . '<code>' . $scholar->color . '</code>',
        'type' => DetailView::INPUT_COLOR,
        'inputWidth' => '40%'
    ],
    [
        'attribute' => 'publish_date',
        'format' => 'date',
        'type' => DetailView::INPUT_DATE,
        'widgetOptions' => [
            'pluginOptions' => ['format' => 'yyyy-mm-dd']
        ],
        'inputWidth' => '40%'
    ],
    [
        'attribute' => 'status',
        'label' => 'Available?',
        'format' => 'raw',
        'value' => $scholar->status ?
            '<span class="label label-success">Yes</span>' :
            '<span class="label label-danger">No</span>',
        'type' => DetailView::INPUT_SWITCH,
        'widgetOptions' => [
            'pluginOptions' => [
                'onText' => 'Yes',
                'offText' => 'No',
            ]
        ]
    ],
    [
        'attribute' => 'sale_amount',
        'label' => 'Sale Amount ($)',
        'format' => 'double',
        'inputWidth' => '40%'
    ],
    [
        'attribute' => 'author_id',
        'format' => 'raw',
        'value' => Html::a('John Steinbeck', '#', [
            'class' => 'kv-author-link'
        ]),
        'type' => DetailView::INPUT_SELECT2,
        'widgetOptions' => [
            'data' => ArrayHelper::map(
                Author::find()->orderBy('name')->asArray()->all(),
                'id',
                'name'
            ),
            'options' => ['placeholder' => 'Select ...'],
            'pluginOptions' => ['allowClear' => true]
        ],
        'inputWidth' => '40%'
    ],
    [
        'attribute' => 'synopsis',
        'format' => 'raw',
        'value' => '<span class="text-justify"><em>' . $scholar->synopsis .
            '</em></span>',
        'type' => DetailView::INPUT_TEXTAREA,
        'options' => ['rows' => 4]
    ]
];

echo DetailView::widget([
    'model' => $scholar,
    'attributes' => $attributes,
    'deleteOptions' => [ // your ajax delete parameters
        'params' => ['id' => $scholar->id, 'custom_param' => true],
    ],
]);
