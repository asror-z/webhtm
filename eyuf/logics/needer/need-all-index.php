<?php


use zetsoft\models\App\eyuf\EyufNeed;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\dbitem\core\WebItem;



/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Список Потребности';
$action->icon = 'fa fa-dashboard';

$action->layout = true;
$action->debug = false;

$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

$model = new EyufNeed();


$model->configs->nameOff = [
    'created_at',
    'modified_at',
    'created_by',
    'modified_by',
];

$model->columns();



/*if (!empty($id))
    $model->configs->query = EyufNeed::find()->all();*/


$date = Az::$app->cores->date;

/*
$model->configs->readonly = function ($model, $key, $index, $widget) use ($date) {
    return true;
};*/

$model->configs->changeSave = true;
$model->configs->changeReload = true;

$model->columns();

$this->pjaxBegin();
/** @var ZView $this */
echo ZDynaWidget::widget([
    'model' => $model,
    'rightBtn' => [
        'update' => [
            'content' => '',
            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
        ],
        'clear_update' => [
            'content' => '{clear_update}',
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
        'pjax' => false,
    ]
]);

$this->pjaxEnd();










