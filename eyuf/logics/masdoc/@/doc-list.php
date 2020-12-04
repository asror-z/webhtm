<?php


use kartik\widgets\Alert;
use zetsoft\models\user\User;
use zetsoft\models\App\eyuf\EyufDocument;
use zetsoft\models\App\eyuf\EyufScholar;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZViewWidget;
use zetsoft\widgets\notifier\ZKAlertWidget;
use zetsoft\widgets\themes\ZCardProfileWidget;
use zetsoft\dbitem\core\WebItem;



$action = new WebItem();

$action->title = Azl . 'Список Документ';
$action->icon = 'fa fa-gg-circle';


$action->layout = true; $action->debug = false;


$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

$scholarId = $this->httpGet('scholarId');
/** @var EyufScholar $scholar */
$scholar = EyufScholar::findOne($scholarId);
$user = User::findOne(['id' => $scholar->user_id]);

$imageUrl = $user->userPhoto();
$id = $this->httpGet('id');

if (empty($id))
{
    echo ZKAlertWidget::widget([
        'config' => [
            'type' => Alert::TYPE_WARNING,
            'body' => 'Нету ID',
            'title' => 'Ошибка',
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
            'body' => 'Стипендиант не найден',
            'title' => 'Ошибка',
            'delay' => 0,
            'isShowSeparator' => true,
        ]
    ]);
    return false;
}


$docs = new EyufDocument();
$docs->configs->query = EyufDocument::find()
    ->where([
        'eyuf_scholar_id' => $id
    ]);

$docs->configs->edit = false;
/*$docs->configs->edits = [
    'status'
];*/
$docs->configs->nameOff = [
    'correct'
];

/** @var ZView $this */



?>

<div class="row">
    <div class="col-md-4">
        <?php

        ZCardProfileWidget::begin([
            'config' => [

                'imageUrl' => $imageUrl,
                'color' => ZColor::color['primary-color'],
                'title' => $scholar->title,
            ]
        ]);
        echo (new EyufScholar())->_program[$scholar->program] . EOL;
        if (!empty($scholar->status))
            echo 'Статус: ' . (new EyufScholar())->_status[$scholar->status];
        ZCardProfileWidget::end();

        echo ZViewWidget::widget([
            'model' => $scholar,
        ]);
        ?>

    </div>


<div class="col-md-8">


<?


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
        'title' => Az::l('Список документов | ') . $scholar->title,
        'edit' => false,
        'toolbar' => false,
        'columnCheckbox' => false,
        'search' => false,
        'topCreate' => true,
        'topUpdate' => true,
        'actionDelete' => false,
        'actionClone' => false,
        'topFilter' => false,
        'topSort' => false,
        'topSetting' => true,
        'topExport' => true,
        'titleCreate' => Az::l('Добавить документ'),
        'createUrl' => 'add-doc'
    ]
]);
?>
</div>

</div>






