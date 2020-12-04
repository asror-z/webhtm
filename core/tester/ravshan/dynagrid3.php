<?php


use kartik\dynagrid\DynaGrid;
use kartik\editable\Editable;
use kartik\grid\DataColumn;
use kartik\grid\EditableColumn;
use kartik\grid\GridView;
use kartik\popover\PopoverX;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use zetsoft\former\libra\Data_2;
use zetsoft\models\user\UserCompany;
use zetsoft\models\place\PlaceCountry;
use zetsoft\models\core\CoreInput;
use zetsoft\models\user\User;
use zetsoft\system\actives\ZActiveRecord;
use zetsoft\system\actives\ZArrayQuery;
use zetsoft\system\Az;
use zetsoft\system\column\ZKEditableColumn;
use zetsoft\system\helpers\ZArrayHelper;
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


echo DynaGrid::widget([
    'columns' => $columns,
    'theme' => 'panel-danger',
    'showPersonalize' => false,
    'storage' => 'db',
    'gridOptions' => [
        'dataProvider' => $models->search(),
        'filterModel' => $models,
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
    'options' => ['id' => 'dynagrid-1'] // a unique identifier is important
]);
