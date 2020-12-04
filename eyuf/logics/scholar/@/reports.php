<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

use zetsoft\models\App\eyuf\EyufReport;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZViewWidget;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\dbitem\core\WebItem;

/** @var ZView $this */


$action = new WebItem();

$action->title = Azl . 'Просмотр Отчета';
$action->icon = 'fa fa-gift';


$action->layout = true; $action->debug = false;


$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();$user = $this->userIdentity();
$Sch = \zetsoft\models\App\eyuf\EyufScholar::findOne(['user_id' => $user->id]);
$report = new EyufReport();
$report->configs->editsEx = ['accept'];

$report->configs->query = EyufReport::find()
    ->where([

    ]);

$report->configs->edit = true;
$report->configs->nameOff = [
    'correct'
];

$report->configs->readonly = function ($model, $key, $index, $widget) {
    return $model->accept === true || ZArrayHelper::isIn($widget->attribute, [
            'accept',
            'correct',
            'created_at',
            'comment',
            'eyuf_scholar_id'
        ]);

};

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
        'actionEdit' => false,
        'topFilter' => false,
        'toolbar' => false,
        'topSetting' => true,
        'topExport' => true,
        'updateUrl' => 'logics/scholar/update_report',
        'viewUrl' => 'logics/scholar/view-report',


    ]
]);


