<?php


use zetsoft\models\App\eyuf\EyufDocument;
use zetsoft\models\App\eyuf\EyufReport;
use zetsoft\models\App\eyuf\EyufScholar;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\dbitem\core\WebItem;



$action = new WebItem();

$action->title = Azl . 'Список отчетов';
$action->icon = 'fa fa-gg-circle';


$action->layout = true; $action->debug = false;


$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();


$docs = new EyufReport();
$docs->configs->query = EyufReport::find()
    ->where([
        'eyuf_scholar_id' => $this->httpGet('id')
    ]);

$docs->configs->edit = true;
$docs->configs->edits = [
    'accept'
];
$docs->configs->nameOff = [
    'correct'
];

/** @var ZView $this */
echo ZDynaWidget::widget([
    'model' => $docs,
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
        'title' => Az::l('Мои документы'),
        'edit' => false,
        'columnCheckbox' => false,
        'toolbar' => false,
        'topCreate' => true,
        'topUpdate' => true,
        'actionDelete' => false,
        'actionClone' => false,
        'topFilter' => false,
        'perfectScrollbar' => true,
        'topSort' => false,
        'topSetting' => true,
        'topExport' => true,
        'titleCreate' => Az::l('Добавить документ'),
    ]
]);








