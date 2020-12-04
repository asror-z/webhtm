<?php


use kartik\widgets\Alert;
use zetsoft\models\App\eyuf\EyufDocument;
use zetsoft\models\App\eyuf\EyufReport;
use zetsoft\models\App\eyuf\EyufScholar;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZViewWidget;
use zetsoft\widgets\notifier\ZKAlertWidget;
use zetsoft\widgets\themes\ZCardProfileWidget;
use zetsoft\dbitem\core\WebItem;


$action = new WebItem();
$action->title = Azl . 'Список Документ';
$action->icon = 'fa fa-gg-circle';
$action->layout = true;
$action->debug = false;
$this->paramSet(paramAction, $action);
$this->title();
$this->toolbar();

$id = $this->httpGet('id');

if (empty($id)) {
    echo ZKAlertWidget::widget([
        'config' => [
            'type' => Alert::TYPE_WARNING,
            'body' => Az::l('Неверный ID'),
            'title' => Az::l('Ошибка'),
            'delay' => 0,
            'isShowSeparator' => true,
        ]
    ]);
    return false;
}

/** @var EyufScholar $scholar */
$scholar = EyufScholar::findOne([
    'id' => $id
]);


if ($scholar === null) {
    echo ZKAlertWidget::widget([
        'config' => [
            'type' => Alert::TYPE_WARNING,
            'body' => Az::l('Стипендиант не найден'),
            'title' => Az::l('Ошибка'),
            'delay' => 0,
            'isShowSeparator' => true,
        ]
    ]);
    return false;
}

//start|JakhongirKudratov|2020-10-17

Az::$app->App->eyuf->docs->status($id);

$docs = new EyufDocument();
$docs->configs->query = EyufDocument::find()
    ->where([
        'eyuf_scholar_id' => $id,
    ])->andWhere([
        'need_verify' => true
    ]);

//end|JakhongirKudratov|2020-10-17
$docs->configs->readonly = [
    'id',
    'name',
    'eyuf_document_type_id',
    'eyuf_scholar_id',
    'file',
    
];

?>

<div class="row">
    <div class="col-md-4">
        <?
        echo $this->require('/webhtm/eyuf/cores/block/scholarInfo.php', [
            'scholar' => $scholar,
            'key' => $scholar->id,
        ])
        ?>
    </div>
    <div class="col-md-8">

        <?

        $docs->configs->nameOn = [
            'id',
            'name',
            'eyuf_document_type_id',
            'eyuf_scholar_id',
            'file',
            'verified_email',
            'file_comment',
            'comment',
        ];

        $docs->columns();

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
                'title' => Az::l('Список документов | ') . $scholar->name,
                'edit' => false,
                'toolbar' => false,
                'titleSummary' => false,
                'columnCheckbox' => false,
                'columnAction' => false,
                'search' => false,
                'topCreate' => true,
                'topUpdate' => true,
                'actionDelete' => false,
                'actionClone' => false,
                'actionView' => false,
                'topFilter' => false,
                'topSort' => false,
                'topSetting' => true,
                'topExport' => true,
                'titleCreate' => Az::l('Добавить документ'),
                'createUrl' => Az::l('add-doc'),
                'summary' => false,
                'panelFooter' => false,
                'columnAfter' => false,
                'columnBefore' => [
                    'checkbox',
                    'action'
                ],
                'actionButtons' => [
                    'update'
                ]

            ]
        ]);


        ?>
    </div>
</div>







