<?php


use zetsoft\system\column\ZKDataColumn;

use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\data\ZForm;
use zetsoft\former\eyuf\NeedEyufCompatriotForm;
use zetsoft\models\App\eyuf\EyufRequest;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\navigat\ZButtonWidget;


$action = new WebItem();

$action->title = Azl.'Запрос к cоотечественникам';
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
            'label' => Az::l('Заполнить'),
            'format' => 'html',
            'width' => '100',
            'value' => function ($model, $key, $index, ZKDataColumn $dataColumn) {
                return ZButtonWidget::widget([
                    'config' => [
                        'text' => Az::l('Заполнить'),
                        'btnRounded' => false,
                        'btnSize' => ZButtonWidget::btnSize['btn-md'],
                        'btnStyle' => ZButtonWidget::btnStyle['btn-outline-link'],
                        'url' => ZUrl::to('/eyuf/logics/moderator/need-compatriot-create.aspx?id=' . ZArrayHelper::getValue($model, 'id'))
                    ],
                    'event' => [
                        'click' => 'function (event){e.preventDefault(); window.open(this.href, "_blank")}',
                    ]
                ]);
            }
        ],

        [
            'class' => ZKDataColumn::class,
            'label' => Az::l('Список'),
            'format' => 'html',
            'width' => '100',
            'value' => function ($model, $key, $index, ZKDataColumn $dataColumn) {
                return ZButtonWidget::widget([
                    'config' => [
                        'text' => Az::l('Список'),
                        'btnRounded' => false,
                        'btnSize' => ZButtonWidget::btnSize['btn-md'],
                        'btnStyle' => ZButtonWidget::btnStyle['btn-outline-link'],
                        'url' => ZUrl::to('/eyuf/logics/moderator/need-compatriot-index.aspx?id=' . ZArrayHelper::getValue($model, 'id'))
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
            'content' => '{update}',
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
        'columnBefore' => [
            'false'
        ],
        'columnAfter' => false,
        'title' => 'Запрос к cоотечественникам',



    ],
]);











