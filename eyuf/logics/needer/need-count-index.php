<?php


use zetsoft\dbitem\core\WebItem;
use zetsoft\models\App\eyuf\EyufNeedCount;
use zetsoft\models\App\eyuf\EyufRequest;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZDynaWidget;

/** @var ZView $this */

$action = new WebItem();

$action->title = Azl . 'Потребности по колличеству';
$action->icon = 'fa fa-dashboard';


$action->layout = true; $action->debug = false;


$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();


$model = new EyufNeedCount();

$model->configs->nameOff = [
    'created_at',
    'modified_at',
    'created_by',
    'modified_by',
];

$model->columns();


//required_ids

$id = $this->httpGet('id');
$company = $this->userIdentity()->getUserCompany()->one();

$companyID = null;
if ($company !== null)
    $companyID = $company->id;


if (empty($id))
    return $this->alertDanger( Az::l('ID запроса отсутсвует'), Az::l('ID is Required'));
    
$model->configs->query = EyufNeedCount::find()
    ->where([
        'user_company_id' => $companyID,
        'eyuf_request_id' => $id
    ]);
    
$request = EyufRequest::findOne($id);


if (empty($request)){
    return $this->alertDanger( Az::l('ID запроса отсутсвует'), Az::l('ID is Required'));
}

$date = Az::$app->cores->date->date();

$model->configs->readonly = function ($model, $key, $index, $widget) use ($date) {
    $item = $date->diff($model->getRequest()->deadline);
    return !$item->expired;
};

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
        'title'=>'Количество потребностей по запросу - ' . $request->id,
        'createUrl' => '/eyuf/logics/moderator/need-count-create.aspx',
        'topCreate' => false,
        'topUpdate' => false,
        'topFilter' => false,
        'topSort' => false,
        'topSetting' => false,
        'topExport' => true,
        'columnAction' => false,
        'perfectScrollbar' => true,
    ]
]);










