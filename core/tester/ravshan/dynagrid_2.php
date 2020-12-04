<?php


use kartik\grid\ActionColumn;
use kartik\grid\EditableColumn;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

$columns =
    [
        [
            'class' => 'kartik\grid\SerialColumn',
            'order' => DynaGrid::ORDER_FIX_LEFT
        ],
        [
            'attribute' => 'name',
            'pageSummary' => 'Page Total',
            'vAlign' => 'middle',
            'order' => DynaGrid::ORDER_FIX_LEFT
        ],
        [
            'attribute' => 'title',
            'filterType' => GridView::FILTER_DATE,
            'format' => 'raw',
            'width' => '170px',
            'filterWidgetOptions' => [
                'pluginOptions' => ['format' => 'yyyy-mm-dd']
            ],
            'visible' => false,
        ],
        [
            'attribute' => 'password',
            'vAlign' => 'middle',
            'width' => '250px',
            'value' => function ($model, $key, $index, $widget) {
                return Html::a($model->author->name, '#', [
                    'title' => 'View author detail',
                    'onclick' => 'alert("This will open the author page.\n\nDisabled for this asset!")'
                ]);
            },
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(Author::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
            ],
            'filterInputOptions' => ['placeholder' => 'Any author'],
            'format' => 'raw'
        ],
        [
            'attribute' => 'email',
            'hAlign' => 'right',
            'vAlign' => 'middle',
            'width' => '100px',
            'format' => ['decimal', 2],
            'pageSummary' => true
        ],
        [
            'attribute' => 'name',
            'vAlign' => 'middle',
            'hAlign' => 'right',
            'width' => '100px',
            'format' => ['decimal', 2],
            'pageSummary' => true
        ],
        [
            'class' => EditableColumn::class,
            'attribute' => 'status',
            'vAlign' => 'middle',
        ],
        [
            'class' => ActionColumn::class,
            'dropdown' => false,
            'urlCreator' => function ($action, $model, $key, $index) {
                return '#';
            },

        ],
        ['class' => 'kartik\grid\CheckboxColumn', 'order' => DynaGrid::ORDER_FIX_RIGHT],
    ];


DynaGrid::widget([
    'columns' => $columns,
    'theme' => 'panel-info',
    'showPersonalize' => true,
    'storage' => 'session',
    'gridOptions' => [
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'showPageSummary' => true,
        'floatHeader' => true,
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
    'options' => ['id' => 'dynagrid-1'] // a unique identifier is important
]);
