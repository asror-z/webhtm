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
use yii\bootstrap\Modal;
use zetsoft\models\ALL\CoreCompany;
use zetsoft\models\ALL\CoreCountry;
use zetsoft\models\ALL\CoreRole;
use zetsoft\models\core\CoreSetting;
use zetsoft\models\user\User;
use zetsoft\models\App\eyuf\EyufCompatriot;
use zetsoft\models\App\eyuf\Program;
use zetsoft\models\App\eyuf\EyufScholar;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZDynaArrayGridWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\themes\ZAdminCardWidget;
use zetsoft\dbitem\core\WebItem;

/** @var ZView $this */


$action = new WebItem();

$action->title = Azl . 'Настройка';
$action->icon = 'fal fa-print';
$action->layout = true; $action->debug = false;

$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

$model = new CoreSetting();

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
        'perfectScrollbar' => true,
        'createUrl' => '{fullUrl}/create_settings.aspx',
        'updateUrl' => '{fullUrl}/update_settings.aspx?id={id}&model={modelClass}',
        'viewUrl' => '{fullUrl}/view_settings.aspx?id={id}',
    ]
]);
