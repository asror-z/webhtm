<?php

use rmrevin\yii\fontawesome\FA;
use zetsoft\models\App\eyuf\EyufDocument;
use zetsoft\models\App\eyuf\EyufReport;
use zetsoft\models\App\eyuf\EyufScholar;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\dbitem\core\WebItem;


$action = new WebItem();

$action->title = Azl . 'Профиль';
$action->icon = 'fal fa-print';


$action->layout = true; $action->debug = false;


$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();


$action->icon = '';


$Sch = EyufScholar::findOne(['user_id' => $this->userIdentity()->id]);

$docs = new EyufDocument();
$docs->configs->query = EyufDocument::find()
    ->where([
        'eyuf_scholar_id' => $Sch->id
    ]);

$docs->configs->edit = true;
if ($this->userRole() === 'scholar') {
    $docs->configs->nameOff = [
        'correct'
    ];
    $docs->configs->editsEx = [
        'status',
        'correct'
    ];
}


/** @var ZView $this */
echo ZDynaWidget::widget([
    'model' => $docs,
    'config' => [
        'title' => Az::l('Мои документы'),
        'titleCreate' => Az::l('Добавить документ'),
        'actionClone' => false,
        'createUrl' => '/logics/scholar/doc-add.aspx',
        'viewUrl' => '/logics/scholar/doc-show',
        'updateUrl' => '/logics/scholar/doc-update',
        'btnEdit' => function ($url, $model) {
            if ($model->status !== true)
                return ZButtonWidget::widget([
                    'config' => [

                        'title' => Az::l('Изменить'),
                        'url' => '/eyuf/logics/scholar/doc-update?id=' . $model->id,
                        'hasIcon' => true,
                        'btnRounded' => false,
                        'btn' => false,
                        'icon' => 'fa fa-' . FA::_EDIT,
                        'confirm' => 'Are you sure you want DELETE columns?'
                    ]
                ]);
        }
    ],

]);


$report = new EyufReport();
$report->configs->query = EyufReport::find()
    ->where([
        'eyuf_scholar_id' => $Sch->id
    ]);

$report->configs->edit = true;
$report->configs->nameOff = [
    'correct'
];

/** @var ZView $this */
echo ZDynaWidget::widget([
    'model' => $report,
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
        'topSetting' => true,
        'topExport' => true,
        'titleCreate' => Az::l('Добавить отчет'),
        'createUrl' => '/logics/scholar/add-report.aspx'
    ]
]);

?>
