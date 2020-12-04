<?php

use zetsoft\system\column\ZKDataColumn;

use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\data\ZForm;
use zetsoft\models\App\eyuf\EyufScholar;
use zetsoft\system\Az;

use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\navigat\ZButtonWidget;

$action = new WebItem();
$action->title = Azl . 'Основное окно';
$action->icon = 'fa fa-gg-circle';
$action->layout = true;
$action->debug = false;
$this->paramSet(paramAction, $action);
$this->title();
$this->toolbar();


$model = new EyufScholar();

$model->configs->query = EyufScholar::find()
    ->where(['not in', 'status', [null, '']])
    ->andWhere([
        'program' => 'masters',
    ])
    ->orWhere([
        'program' => 'doctors'
    ]);



$model->configs->filter = [
    'user_id',
    'user_company_id',
    'title',
    'program',
];

$model->configs->before = [
    'program' => [
        [
            'class' => ZKDataColumn::class,
            'label' => Az::l('Подробно'),
            'value' => function ($model, $key, $index, ZKDataColumn $dataColumn) {

                return ZButtonWidget::widget([
                    'config' => [
                        'btnRounded' => false,
                        'btnSize' => ZButtonWidget::btnSize['btn-sm'],
                        'btnStyle' => ZButtonWidget::btnStyle['btn-outline-primary'],
                        'text' => Az::l('Подробно'),
                        'url' => ZUrl::to('/eyuf/logics/masdoc/doc-list-accept.aspx?id=' . $model['id']),

                    ],
                    'event' => [
                        'click' => 'function (event){e.preventDefault(); window.open(this.href, "_blank")}',
                    ]
                ]);
            }
        ],
        [
            'class' => ZKDataColumn::class,
            'label' => Az::l('отчетов'),
            'value' => function ($model, $key, $index, ZKDataColumn $dataColumn) {

                return ZButtonWidget::widget([
                    'config' => [
                        'btnRounded' => false,
                        'btnSize' => ZButtonWidget::btnSize['btn-sm'],
                        'btnStyle' => ZButtonWidget::btnStyle['btn-outline-primary'],
                        'text' => Az::l('отчетов'),
                        'url' => ZUrl::to('/eyuf/logics/masdoc/doc-list-accept-report.aspx?id=' . $model['id']),

                    ],
                    'event' => [
                        'click' => 'function (event){e.preventDefault(); window.open(this.href, "_blank")}',
                    ]
                ]);
            }
        ],
    ]
];

$model->configs->nameOff = [
    'created_at',
    'modified_at',
    'created_by',
    'modified_by',
];

$model->columns();

/** @var ZView $this */
echo ZDynaWidget::widget([
    'model' => $model,
    'rightBtn' => [
        'update' => [
            'content' => '',
            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
        ],


        'system' => [
            'content' => '',
            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
        ],

        'add-clone-delete' => [
            'content' => '',
            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
        ],

        'filter-sort-id' => [
            'content' => '',
            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
        ],

        'statistics' => [
            'content' => '',
            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
        ],

        'toggleData' => [
            'content' => '{all}',
            'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
        ],
    ],
    'config' => [
        'title' => Az::l('Список стипендиантов'),
        'actionEdit' => false,
        'summary' => false,
        'toolbar' => true,
        'columnCheckbox' => false,
        'search' => false,
        'topCreate' => false,
        'topUpdate' => true,
        'actionDelete' => false,
        'actionClone' => false,
        'topFilter' => false,
        'topSort' => false,
        'topSetting' => true,
        'topExport' => true,
        'columnBefore' => [
            'action'
                        ],
        'actionButtons' => [
            'view',
            'update'
        ],
        'titleCreate' => Az::l('Добавить документ'),
        'perfectScrollbar' => true,
    ]
]);
