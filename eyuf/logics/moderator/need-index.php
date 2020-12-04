<?php


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


$action->layout = true; $action->debug = false;


$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();





$model = new EyufNeed();
$model->configs->nameOff = [
    'user_company_id'
];

$company = new UserCompany();
$company->query = UserCompany::find()
    ->where([
        'user_id' => $this->userIdentity()->id
    ]);


$companyID = null;
if ($company !== null)
    $companyID = $company->id;

$id = $this->httpGet('id');

if (empty($id))
    return $this->alertDanger( Az::l('ID запроса отсутсвует'), Az::l('ID is Required'));


/*$model->configs->query = EyufNeed::find()
    ->where([
        'user_company_id' => $companyID
    ])
    ->andWhere([
        'eyuf_request_id' => $id
    ]);*/
$model->configs->query = EyufNeed::find()
    ->where([
        'eyuf_request_id' => $id
    ]);
$request = \zetsoft\models\App\eyuf\EyufRequest::findOne($id);
$name = 'Пусто';
if (!empty($request->name)){
    $name = $request->name;
}
$date = Az::$app->cores->date;

$model->configs->readonly = function (EyufNeed $model, $key, $index, $widget) use ($date) {

    if ($model->getEyufRequest()) {
        $item = $date->diff($model->getEyufRequest()->deadline);
        return !$item->expired;
    }

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
        'title' =>'Потребности по запросу - '.$name,
        //'createUrl' => ['need-create'],
        'createUrl' => '{fullUrl}/need-create.aspx',
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
        ]
    ]
]);










