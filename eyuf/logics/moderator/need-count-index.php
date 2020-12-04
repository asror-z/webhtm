<?php


use http\Env\EyufRequest;
use zetsoft\models\App\eyuf\EyufNeedCount;
use zetsoft\models\App\eyuf\EyufNeed;
use zetsoft\models\user\UserCompany;
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


$id = $this->httpGet('id');
$user_company_id = $this->userIdentity()->user_company_id;

$model = new EyufNeedCount();

//$company = $this->userIdentity()->getUserCompany();
/*$company = new UserCompany();

$company->query = UserCompany::find()
    ->where([
        'user_id' => $this->userIdentity()->id
    ]);
    
$companyID = null;
if ($company !== null)
    $companyID = $company->id;*/


if (empty($id))
    return $this->alertDanger( Az::l('ID запроса отсутсвует'), Az::l('ID is Required'));


$model->configs->query = EyufNeedCount::find()
    ->where([
        'user_company_id' => $user_company_id
    ])
    ->andWhere([
        'eyuf_request_id' => $id
    ]);

$request = \zetsoft\models\App\eyuf\EyufRequest::findOne($id);


$name = 'Пусто';

if ($request !== null)
    $name = $request->name;


$date = Az::$app->cores->date;

$model->configs->readonly = function ($model) use ($date) {

    $request = \zetsoft\models\App\eyuf\EyufRequest::findOne([
        'id' => $model['eyuf_request_id']
    ]);

    if ($request !== null) {
        $item = $date->diff($request->deadline);
        return !$item->expired;
    }

    return false;
};

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
        'title' => 'Количество потребностей по запросу - ' . $name,
        //'createUrl' => ['need-count-create'],
        'actionEdit' => false,
        'topCreate' => false,
        'actionDelete' => false,
        'actionClone' => false,
        'actionView' => true,
        'columnAction' => false,
        'columnRelation' => false,
        'topSort' => false,
        'topFilter' => false,
        'topSetting' => false,
        'perfectScrollbar' => true,
        'columnAfter' => false,
        'columnBefore' => [
            'checkbox'
        ],

    ]
]);










