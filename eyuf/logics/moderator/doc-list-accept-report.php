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





/** @var ZView $this */

?>

<div class="row">
    <div class="col-md-4">
        <?php

        //start|JakhongirKudratov|2020-10-17

        ZCardProfileWidget::begin([
            'config' => [
                'url' => $this->userPhoto(),
                'color' => ZColor::color['primary-color'],
                'title' => $scholar->name,
            ]
        ]);

        //end|JakhongirKudratov|2020-10-17

      

        ZCardProfileWidget::end();


        /** @var ZView $this */


        $scholar->configs->nameOn = [
            'id',
            'name',
            'program',
            'passport',
            'passport_give',
            'birthdate',
            'user_id',
            'place_country_id',
            'status',
            'edu_start',
            'age',
            'edu_end',
            'currency',
            'user_company_id',
            'company_type',
            'edu_area',
            'edu_sector',
            'edu_type',
            'speciality',
            'edu_place',
            'finance',
            'address',
            'phone',
            'home_phone',
            'email',
            'position',
            'experience',
            'completed',
        ];
        $scholar->columns();

        echo ZViewWidget::widget([
            'model' => $scholar,
        ]);
        ?>

    </div>

    <div class="col-md-8">

        <?

        

        //start|JakhongirKudratov|2020-10-17

        $reports = new EyufReport();
        $reports->query = EyufReport::find()
            ->where([
                'eyuf_scholar_id' => $id
            ]);

        //end|JakhongirKudratov|2020-10-17

        $reports->configs->edit = false;
        $reports->configs->readonly = [
            'id',
            'name',
            'eyuf_scholar_id',
            'file',
            'file_comment',
            'verified_email',

        ];
        $reports->configs->nameOn = [
            'id',
            'name',
            'eyuf_scholar_id',
            'correct',
            'accept',
            'file',
            'file_comment',
            'need_verify',
            'verified_email',
        ];
        $reports->columns();

        /** @var ZView $this */
        echo ZDynaWidget::widget([
            'model' => $reports,
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
                'title' => Az::l('Список отчеты | ') . $scholar->name,

                'columnCheckbox' => false,
                'columnAction' => false,
                'toolbar' => false,
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







