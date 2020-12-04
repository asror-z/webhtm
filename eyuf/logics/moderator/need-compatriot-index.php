<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\App\eyuf\EyufNeedCompatriot;
use zetsoft\models\App\eyuf\EyufNeedEyufCompatriot;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZDynaWidget;

/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Список потребностей по соотечественникам';
$action->icon = 'fa fa-dashboard';
$action->layout = true; $action->debug = false;

$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

$id = $this->httpGet('id');


/*if (empty($id))
    return $this->alertDanger( Az::l('ID запроса отсутсвует'), 'ID is Required');*/


$model = new EyufNeedCompatriot();

$model->configs->nameOff = [
    'user_company_id',
    'created_at',
    'modified_at',
    'created_by',
    'modified_by',
];

$model->columns();


/*$company = $this->userIdentity()->getUserCompany();
$companyID = 10;
if ($company !== null)
    $companyID = 10;*/


/*$model->configs->query = EyufNeedCompatriot::find()
    ->where([
        'user_company_id' => $companyID
    ])->andWhere([
        'eyuf_request_id' => $id
    ]);*/

/*
$model->configs->query = EyufNeedCompatriot::find()
    ->where(['eyuf_request_id' => $id]);*/


/*$request = EyufRequest::find()
    ->where([
        'id' => $id
    ])->select(['name'])->one();*/



/*$model->configs->readonly = function (EyufNeedEyufCompatriot $model, $key, $index, $widget) use ($date) {
    $item = $date->diff($model->getRequest()->deadline);
    return !$item->expired;
};*/







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
        'title' => 'Потребности Соотечественника по запросу - ',
        'createUrl' => '{fullUrl}/need-compatriot-create.aspx',
        'viewUrl' => '{fullUrl}/need-compatriot-view.aspx?id={id}&model={modelClassName}',
        'actionEdit' => true,
        'topCreate' => true,
        'actionDelete' => true,
        'actionClone' => true,
        'actionView' => true,
        'columnAction' => true,
        'columnRelation' => false,
        'topSort' => false,
        'topFilter' => false,
        'topSetting' => false,
        'perfectScrollbar' => true,
        'columnAfter' => false,
        'columnBefore' => [
            'checkbox'
        ]
    ]
]);










