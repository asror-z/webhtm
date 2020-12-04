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
use zetsoft\widgets\themes\ZCardWidget;

/** @var ZView $this */
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

//Az::$app->App->eyuf->docs->status($id);

$docs = new EyufDocument();
$docs->configs->query = EyufDocument::find()
    ->where([
        'eyuf_scholar_id' => $id
    ]);

$docs->configs->nameOff = [
    'eyuf_scholar_id',
    'created_at',
    'modified_at',
    'created_by',
    'modified_by',
];





?>

<div class="row">
    <div class="col-md-4">
        <?php

        ZCardProfileWidget::begin([
            'config' => [
                'url' => $this->userPhoto(),
                'color' => ZColor::color['primary-color'],
                'title' => $scholar->name,
            ]
        ]);
        if (!empty($scholar->program))
            echo (new EyufScholar())->_program[$scholar->program];
        echo EOL;
        //        if (!empty($scholar->status))
        ///echo 'Статус: ' . (new EyufScholar())->_status[$scholar->status];

        ZCardProfileWidget::end();

        echo ZViewWidget::widget([
            'model' => $scholar,
        ]);
        ?>

    </div>

    <div class="col-md-8">

        <?

        ZCardWidget::begin([
            'config' => [
                /* start|AzimjonToirov|24-10-2020 */
                'title' => Az::l('Список документов стипендианта'),
                'classHeadColor' => 'bg-primary text-white'
                /* end|AzimjonToirov|24-10-2020 */
            ]
        ]);

      
        $docs->columns();

        echo ZDynaWidget::widget([
            'model' => $docs,

            'config' => [
                'showFooter' => false,
                'titleSummary' => true,
                'isCard' => false,
                'columnBefore' => [
                    //  'action'
                ],
                'hasAction' => false,
                'actionButtons' => [
                    'update'
                ],
                'pjax' => false,
                'columnAfter' => false,
                'hasToolbar' => true,
                'search' => false,
                'heighbody' => '100%',
                'summary' => true,
                'perfectScrollbar' => true,
                'striped' => false,
                'hasWidth' => false,
                //'panelTemplate' => "{items}",
            ]
        ]);
        ZCardWidget::end();

        ?>
    </div>
</div>

<script>

    $(document).ready(function () {

        let dyna = $('.tr-dynawidget');
        let checks = '';

        $.each(dyna, function (key, value) {
            console.log(value);
            checks = $(value).find('.fa-check');
            console.log(checks.length);

            if (checks.length > 1) {
                $(value).attr('readonly', true);
            }
        });

    })

</script>







