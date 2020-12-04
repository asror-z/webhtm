<?php


use zetsoft\former\eyuf\EyufCompatriotForm;
use zetsoft\models\core\CoreSetting;
use zetsoft\models\App\eyuf\EyufCompatriot;
use zetsoft\models\App\eyuf\EyufNeed;
use zetsoft\models\App\eyuf\EyufRequest;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\dbitem\core\WebItem;
/** @var ZView $this */


$action = new WebItem();

$action->title = Azl . 'Соотечественники';
$action->icon = 'fa fa-graduation-cap';

$action->layout = true; $action->debug = false;

$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();


//$id = $this->httpGet('id');

/** @var EyufRequest $model */
/*$request = CoreSetting::findOne([
    'name' => EyufCompatriotForm::class
]);*/

/*if ($request === null) {
    return $this->alertDanger( "ID = $id", Az::l('Форма не настроена!'));
}*/

$model = new EyufCompatriot();

/*$model->configs->denyDB = $request->value;*/
$model->configs->nameOff = [
    'user_company_id',
    'eyuf_request_id'
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
        'toolbar' => false,
        'columnAction' => false,
    ]
]);










