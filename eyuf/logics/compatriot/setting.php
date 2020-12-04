<?php

use zetsoft\system\column\ZKDataColumn;

use zetsoft\dbitem\core\WebItem;
use zetsoft\former\eyuf\EyufCompatriotForm;
use zetsoft\models\core\CoreSetting;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\navigat\ZButtonWidget;



/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Форма соотечественников';
$action->icon = 'fa fa-credit-card';
$action->layout = true;
$action->debug = false;
$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

$model = new CoreSetting();

$model->configs->query = CoreSetting::find()
    ->where([
        'name' => EyufCompatriotForm::class
    ]);

$model->configs->nameOff = [
    'name',
];

$model->configs->before = [
    'value' => [
        [
            'class' => ZKDataColumn::class,
            'label' => Az::l('Формировать'),
            'value' => function ($model, $key, $index, ZKDataColumn $dataColumn) {
                return ZButtonWidget::widget([
                    'config' => [
                        'text' => Az::l('Настроить видимость'),
                        'btnRounded' => false,
                        'btnSize' => ZButtonWidget::btnSize['btn-md'],
                        'btnStyle' => ZButtonWidget::btnStyle['btn-outline-link'],
                        'url' => ZUrl::to('/logics/EyufCompatriot/form.aspx?id=' . $model->id)
                    ],
                    'event' => [
                        'click' => 'function (event){e.preventDefault(); window.open(this.href, "_blank")}',
                    ]
                ]);
            }
        ],
        [
            'class' => ZKDataColumn::class,
            'label' => Az::l('Заполнить'),
            'value' => function ($model, $key, $index, ZKDataColumn $dataColumn) {
                return ZButtonWidget::widget([
                    'config' => [
                        'text' => Az::l('Заполнить'),
                        'btnRounded' => false,
                        'btnSize' => ZButtonWidget::btnSize['btn-md'],
                        'btnStyle' => ZButtonWidget::btnStyle['btn-outline-link'],
                        'url' => ZUrl::to('/logics/EyufCompatriot/create.aspx?id=' . $model->id)
                    ],
                    'event' => [
                        'click' => 'function (event){e.preventDefault(); window.open(this.href, "_blank")}',
                    ]
                ]);
            }
        ],

    ]
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
        'columnRelation' => false,
        'actionEdit' => false,
        'columnAction' => false,
        'createUrl' => '/crud/core-setting/create.aspx',

    ]
]);










