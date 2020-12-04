<?php

use rmrevin\yii\fontawesome\FA;
use zetsoft\dbitem\core\WebItem;
use zetsoft\models\ALL\CoreCountry;
use zetsoft\models\user\User;
use zetsoft\models\App\eyuf\EyufDocument;
use zetsoft\models\App\eyuf\EyufReport;
use zetsoft\models\App\eyuf\EyufScholar;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZArray5Widget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\former\ZViewWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZKAlertBlockWidget;
use zetsoft\widgets\notifier\ZModalNewWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\widgets\themes\ZCardProfileWidget;


/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Мои отчеты';
$action->icon = 'fa fa-area-chart';
$action->type = WebItem::type['html'];
$action->layout = true;
$action->debug = false;


$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();
/** @var User $model */
$model = $this->userIdentity();

/** @var EyufScholar $scholar */
$scholar = EyufScholar::find()
    ->where([
        'user_id' => $this->userIdentity()->id
    ])
    ->one();


if ($scholar === null)
    return $this->alertWarning(Az::l('Стипендиант не найден'), $this->userIdentity()->id);


$list = Az::$app->App->eyuf->docs->getDocList();
$count = count($list);


?>

<div class="row">
    <div class="col-md-12">
        <?php


        $report = new EyufReport();
        $report->configs->editsEx = ['accept'];
        //  $report->configs->edits = ['modified_by'];
        $report->configs->query = EyufReport::find()
            ->where([
                'eyuf_scholar_id' => $scholar->id
            ]);

        $report->configs->edit = false;
        $report->configs->nameOff = [
            'correct', 'eyuf_scholar_id'
        ];

        /*$report->configs->readonly = function ($model, $key, $index, $widget) {
            return $model->accept === true || ZArrayHelper::isIn($widget->attribute, [
                    'accept',
                    'correct',
                    'created_at',
                    'comment',
                    'verified',
                    'need_verify'
                ]);

        };*/

        $report->configs->nameOff = [
            'created_at',
            'modified_at',
            'created_by',
            'modified_by',
        ];

        $report->columns();

        /** @var ZView $this */
        echo ZDynaWidget::widget([
            'model' => $report,
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
                'title' => Az::l('Мои отчеты'),
                'edit' => false,
                'columnCheckbox' => false,
                'search' => false,
                'topCreate' => true,
                'topUpdate' => true,
                'actionDelete' => false,
                'actionClone' => false,
                'topFilter' => false,
                'topSort' => false,
                'perfectScrollbar' => true,
                'topSetting' => true,
                'topExport' => true,
                'titleCreate' => Az::l('Добавить отчет'),
                
            ]
        ]);


        ?>
    </div>
</div>
