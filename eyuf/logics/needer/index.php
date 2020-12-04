<?php

use zetsoft\system\column\ZKDataColumn;

use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\data\ZForm;
use zetsoft\models\App\eyuf\EyufRequest;
use zetsoft\system\Az;

use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\navigat\ZButtonWidget;

$action = new WebItem();

$action->title = Azl . 'Запросы';
$action->icon = 'fa fa-graduation-cap';
$action->layout = true;
$action->debug = false;


$this->paramSet(paramAction, $action);

$this->title();

$this->toolbar();


$model = new EyufRequest();

$model->configs->before = [
    'title' => [
        [
            'class' => ZKDataColumn::class,
            'label' => Az::l('Формировать'),
            'width' => '100px',
            'value' => function ($model, $key, $index, ZKDataColumn $dataColumn) {
                return ZButtonWidget::widget([
                    'config' => [
                        'text' => Az::l('Формировать'),
                        'btnRounded' => false,
                        'btnSize' => ZButtonWidget::btnSize['btn-md'],
                        'btnStyle' => ZButtonWidget::btnStyle['btn-outline-link'],
                        'url' => ZUrl::to('/eyuf/logics/needer/update.aspx?id=' . $model['id'])
                    ],
                    'event' => [
                        'click' => 'function (event){
                                e.preventDefault(); 
                                window.open(this.href, "_blank")
                            }',
                    ]
                ]);
            }
        ],

    ]
];

$model->configs->nameOff = [
    'value',
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

     /*   */

        'system' => [
            'content' => '',
            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
        ],

        'add-clone-delete' => [
            'content' => '{add}{tabular}{clone}{delete}',
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

        'export' => [
            'content' => '{jsonExcel}{export}',
            'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
        ],

        'toggleData' => [
            'content' => '{all}',
            'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
        ],

        'filterPjax' => [
            'content' => '',
            'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
        ],
    ],

    'config' => [
        'topCreate' => true,
        'perfectScrollbar' => true,
       /* 'actionButtons' => [
            'view',
            'delete',
        ],*/
        'columnAfter' => false,
        'spaArray' => [
            'create' => true
        ]

    ],

]);
