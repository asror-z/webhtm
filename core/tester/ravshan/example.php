<?php

use kartik\dynagrid\DynaGrid;
use kartik\grid\DataColumn;
use yii\helpers\Html;
use zetsoft\former\libra\Data;
use zetsoft\former\libra\Data_2;
use zetsoft\system\actives\ZArrayQuery;


$columns =
    [
        [
            'class' => ZKDataColumn::class,
            'attribute' => 'password',
        ],

        [
            'class' => ZKDataColumn::class,
            'attribute' => 'name',

        ],
        [
            'class' => ZKDataColumn::class,
            'attribute' => 'text',

        ],

    ];





$query = new ZArrayQuery();
$query->andFilterWhere(['like', 'name', 78]);


$filter = new Data_2();
$provider = $filter->search();

echo DynaGrid::widget([

    'columns' => $columns,

    'theme' => 'panel-info',
    'showPersonalize' => true,
    'storage' => 'session',
    'gridOptions' => [
        'dataProvider' => $provider,
        'filterModel' => $filter,
        'showPageSummary' => true,
        'floatHeader' => false,
        'pjax' => true,
        'responsiveWrap' => false,
        'panel' => [
            'heading' => '<h3 class="panel-title"><i class="fas fa-book"></i>  Library</h3>',
            'before' => '<div style="padding-top: 7px;"><em>* The table header sticks to the top in this asset as you scroll</em></div>',
            'after' => false
        ],
        'toolbar' => [
            ['content' =>
                Html::button('<i class="fas fa-plus"></i>', ['type' => 'button', 'title' => 'Add Book', 'class' => 'btn btn-success', 'onclick' => 'alert("This will launch the book creation form.\n\nDisabled for this asset!");']) . ' ' .
                Html::a('<i class="fas fa-repeat"></i>', ['dynagrid-asset'], ['data-pjax' => 0, 'class' => 'btn btn-outline-secondary', 'title' => 'Reset Grid'])
            ],
            ['content' => '{dynagridFilter}{dynagridSort}{dynagrid}'],
            '{export}',
        ]
    ],
    'options' => ['id' => 'dynagrid-1']
]);
