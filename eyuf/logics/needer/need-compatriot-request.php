<?php


use zetsoft\system\column\ZKDataColumn;

use zetsoft\dbitem\data\ZForm;
use zetsoft\former\eyuf\NeedEyufCompatriotForm;
use zetsoft\models\App\eyuf\EyufNeed;
use zetsoft\models\App\eyuf\EyufRequest;
use zetsoft\models\App\eyuf\EyufScholar;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\dbitem\core\WebItem;




$action = new WebItem();

$action->title = Azl . 'Запрос к соотечественникам';
$action->icon = 'fa fa-graduation-cap';


$action->layout = true; $action->debug = false;


$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();




$model = new EyufRequest();

$model->configs->before = [
    'title' => [
        [
            'class' => ZKDataColumn::class,

            'label' => 'Список',
            'value' => function ($model, $key, $index, ZKDataColumn $dataColumn) {
                
                return ZButtonWidget::widget([
                    'config' => [
                        'text' => 'Список',
                        'btnRounded' => false,
                        'btnSize' => ZButtonWidget::btnSize['btn-md'],
                        'btnStyle' => ZButtonWidget::btnStyle['btn-outline-link'],
                        'url' => ZUrl::to('/logics/needer/need-EyufCompatriot-index.aspx?id=' . $model['id'])
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
        'topCreate' => false,
        'columnAction' => false,
        'columnCheckbox' => false,
        'actionDelete' => false,
        'actionClone' => false,
        'columnRelation' => false,

    ],
]);











