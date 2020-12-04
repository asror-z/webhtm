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

$id = $this->httpGet('id');

$model = new EyufNeed();

if (!empty($id))
    $model->configs->query = EyufNeed::find()
        ->andWhere([
            'eyuf_request_id' => $id
        ]);

$date = Az::$app->cores->date->date();

$request = \zetsoft\models\App\eyuf\EyufRequest::find()
    ->where([
        'id' => $id
    ])->select(['name'])
    ->one();


$model->configs->readonly = function (EyufNeed $model, $key, $index, $widget) use ($date) {
    if ($model->getRequest() === null)
        return true;

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
        'title' => 'Потребности по запросу - ' . $request,
        'createUrl' => 'create',
        'toolbar' => true,
        'columnAction' => false,
        'topExport' => true,
        'perfectScrollbar' => true,
        'spaArray' => [
            'create' => false
        ]
    ]
]);
