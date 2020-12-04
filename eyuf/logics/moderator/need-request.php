<?php


use zetsoft\system\column\ZKDataColumn;

use zetsoft\dbitem\data\ZForm;
use zetsoft\former\eyuf\EyufNeedForm;
use zetsoft\models\App\eyuf\EyufNeed;
use zetsoft\models\App\eyuf\EyufRequest;
use zetsoft\models\App\eyuf\EyufScholar;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\dbitem\core\WebItem;


$action = new WebItem();

$action->title = Azl . 'Запросы к стипендиантам';
$action->icon = 'fa fa-graduation-cap';


$action->layout = true;
$action->debug = false;


$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

$model = new EyufRequest();
$model->configs->query = EyufRequest::find()
    ->where([
        'form' => EyufNeedForm::class
    ]);


$model->configs->before = [
    'title' => [
        [
            'class' => ZKDataColumn::class,
            'label' => Az::l('Заполнить'),
            'format' => 'html',
            'value' => function ($model, $key, $index, ZKDataColumn $dataColumn) {
                return ZButtonWidget::widget([
                    'config' => [
                        'text' => Az::l('Заполнить'),
                        'btnRounded' => false,
                        'btnSize' => ZButtonWidget::btnSize['btn-md'],
                        'btnStyle' => ZButtonWidget::btnStyle['btn-outline-link'],
                        'url' => ZUrl::to('/eyuf/logics/moderator/need-create.aspx?id=' . ZArrayHelper::getValue($model, 'id'))
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
            'value' => function ($model, $key, $index, ZKDataColumn $dataColumn) {
                return ZButtonWidget::widget([
                    'config' => [
                        'text' => Az::l('Список'),
                        'btnRounded' => false,
                        'btnSize' => ZButtonWidget::btnSize['btn-md'],
                        'btnStyle' => ZButtonWidget::btnStyle['btn-outline-link'],
                        'url' => ZUrl::to('/eyuf/logics/moderator/need-index.aspx?id=' . ZArrayHelper::getValue($model, 'id'))
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
    'value',
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
        'columnAfter' => false,
        'columnBefore' => [
            'false'
        ],
        'title' => 'Запросы к стипендиантам',

    ],
]);











