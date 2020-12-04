<?php


use zetsoft\dbitem\core\WebItem;
use zetsoft\models\App\eyuf\EyufCompatriot;
use zetsoft\models\App\eyuf\EyufNeedCompatriot;
use zetsoft\models\user\UserCompany;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZDynaWidget;

/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Список потребности к соотечественникам';
$action->icon = 'fa fa-dashboard';
$action->layout = true;
$action->debug = false;


$this->paramSet(paramAction, $action);

$this->title();

// ids

$id = $this->httpGet('id');
$user_company_id = $this->userIdentity()->user_company_id;


/*$company = new UserCompany();

$company->query = UserCompany::find()
    ->where([
        'user_id' => $this->userIdentity()->id
    ]);
    $company->columns();
*/

/*$companyID = null;
if ($company !== null)
    $companyID = $company->id;*/



$model = new EyufNeedCompatriot();

if (empty($id))
    return $this->alertDanger( Az::l('ID запроса отсутсвует'), Az::l('ID is Required'));


    $model->configs->query = EyufNeedCompatriot::find()
        ->where([
            'user_company_id' => $user_company_id,
            'eyuf_request_id' => $id
        ]);


    $model->configs->nameOff = [
        'user_company_id',
        'created_at',
        'modified_at',
        'created_by',
        'modified_by',
    ];

    $request = \zetsoft\models\App\eyuf\EyufRequest::findOne($id);

    $name = 'Пусто';

    if ($request !== null)
        $name = $request->name;


    if (empty($id))
        return $this->alertDanger( Az::l('ID запроса отсутсвует'), Az::l('ID is Required'));

    $date = Az::$app->cores->date;

    $model->configs->readonly = function (EyufCompatriot $model, $key, $index, $widget) use ($date) {
        $item = $date->diff($model->getRequest()->deadline);
        return !$item->expired;
    };

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
            'title' => 'Потребности Соотечественника по запросу - ' . $name,
        ]

    ]);










