<?php

/**
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

use zetsoft\system\column\ZKDataColumn;

use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\data\ZForm;
use zetsoft\models\ALL\CoreRole;
use zetsoft\models\App\eyuf\EyufScholar;
use zetsoft\models\App\eyuf\Program;
use zetsoft\models\user\User;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\themes\ZAdminCardWidget;


/** @var ZView $this */
$action = new WebItem();

$action->layout = true;
$action->debug = false;
$action->icon = 'fa fa-graduation-cap';
$action->title = Azl . 'Окно модератора';

$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

/** @var ZView $this */
$user = $this->userIdentity();
$model = User::findOne($user->id);
$company = $user->user_company_id;
$scholar = new EyufScholar();

$intern = 0;
$masters = 0;
$doctors = 0;
$qualify = 0;

if ($this->userRole() !== 'moderator')
    $this->alertWarning(Az::l('Необходимо зайти с ролью модератора'));

if (($company !== null)) {
    $scholar->configs->query = EyufScholar::find()
        ->where([
            'user_company_id' => $company,
        ]);

    $intern = EyufScholar::find()
        ->where([
                'user_company_id' => $company,
                'program' => EyufScholar::program['intern']]
        )->count();

    $doctors = EyufScholar::find()
        ->where([
                'user_company_id' => $company,
                'program' => EyufScholar::program['doctors']]
        )->count();

    $masters = EyufScholar::find()
        ->where([
                'user_company_id' => $company,
                'program' => EyufScholar::program['masters']]
        )->count();

    $qualify = EyufScholar::find()
        ->where([
                'user_company_id' => $company,
                'program' => EyufScholar::program['qualify']]
        )->count();

    $scholar->configs->before = [
        'program' => [
            [
                'class' => ZKDataColumn::class,
                'label' => Az::l('Подробно'),
                'value' => function ($model, $key, $index, ZKDataColumn $dataColumn) {
                    return ZButtonWidget::widget([
                        'config' => [
                            'btnRounded' => false,
                            'btnSize' => ZButtonWidget::btnSize['btn-sm'],
                            'btnStyle' => ZButtonWidget::btnStyle['btn-outline-primary'],
                            'text' => Az::l('Подробно'),
                            'url' => ZUrl::to('/eyuf/logics/moderator/doc-list-accept.aspx?id=' . $model['id']),
                        ],
                        'event' => [
                            'click' => 'event.preventDefault(); window.open(this.href, "_blank")',
                        ]
                    ]);
                }
            ],
            [
                'class' => ZKDataColumn::class,
                'label' => Az::l('отчетов'),
                'value' => function ($model, $key, $index, ZKDataColumn $dataColumn) {
                    return ZButtonWidget::widget([
                        'config' => [
                            'btnRounded' => false,
                            'btnSize' => ZButtonWidget::btnSize['btn-sm'],
                            'btnStyle' => ZButtonWidget::btnStyle['btn-outline-primary'],
                            'text' => Az::l('отчетов'),
                            'url' => ZUrl::to('/eyuf/logics/moderator/doc-list-accept.aspx?id=' . $model['id']),
                        ],
                        'event' => [
                            'click' => 'event.preventDefault(); window.open(this.href, "_blank")',
                        ]
                    ]);
                }
            ],
        ]
    ];
}
?>

<div class="row">
    <div class="col-lg-3 col-md-6">
        <?php
        //    firstCard
        echo ZAdminCardWidget::widget([
            'config' => [
                'template' => 'second',
                'textPosition' => ZAdminCardWidget::textPosition['textLeft'],
                'isCardHeader' => true,
                'cardTitleBool' => true,
                'headerTitle' => Az::l('Магистратура'),
                'bodyTitle' => $masters,
                'bodyText' => '',
                'color' => ZColor::color['primary-color'],
                'icon' => 'fas fa-user-graduate',
                'isImage' => false,
                'iconColor' => ZColor::color['teal'],
                'footerText' => '',
                'badge' => '',
                'footerColor' => ZColor::color['primary-color-dark'],
            ]
        ]);
        ?>
    </div>

    <div class="col-lg-3 col-md-6">
        <?php
        //    firstCard
        echo ZAdminCardWidget::widget([
            'config' => [
                'template' => 'second',
                'textPosition' => ZAdminCardWidget::textPosition['textLeft'],
                'isCardHeader' => true,
                'cardTitleBool' => true,
                'headerTitle' => Az::l('Докторантура'),
                'bodyTitle' => $doctors,
                'bodyText' => '',
                'color' => ZColor::color['success-color'],
                'icon' => 'fas fa-user-tie',
                'iconBack' => ZColor::color['transparent'],
                'footerText' => '',
                'badge' => '',
                'footerColor' => ZColor::color['primary-color-dark'],
                'isImage' => false,
            ]
        ]);

        ?>
    </div>

    <div class="col-lg-3 col-md-6">
        <?php
        //    firstCard
        echo ZAdminCardWidget::widget([
            'config' => [
                'template' => 'second',
                'textPosition' => ZAdminCardWidget::textPosition['textLeft'],
                'isCardHeader' => true,
                'cardTitleBool' => true,
                'headerTitle' => Az::l('Стажировка'),
                'bodyTitle' => $intern,
                'bodyText' => '',
                'color' => ZColor::color['danger-color'],
                'icon' => 'fas fa-university',
                'iconColor' => ZColor::color['teal'],
                'iconBack' => ZColor::color['transparent'],
                'footerText' => '',
                'badge' => '',
                'footerColor' => ZColor::color['primary-color-dark'],
                'isImage' => false,
            ]
        ]);

        ?>
    </div>

    <div class="col-lg-3 col-md-6">
        <?php
        //    firstCard
        echo ZAdminCardWidget::widget([
            'config' => [
                'template' => 'second',
                'textPosition' => ZAdminCardWidget::textPosition['textLeft'],
                'isCardHeader' => true,
                'cardTitleBool' => true,
                'headerTitle' => Az::l('Повышение квалификации'),
                'bodyTitle' => $qualify,
                'bodyText' => '',
                'color' => ZColor::color['warning-color'],
                'icon' => 'fas fa-chart-line',
                'iconColor' => ZColor::color['black'],
                'iconBack' => ZColor::color['transparent'],
                'footerText' => '',
                'badge' => '',
                'footerColor' => ZColor::color['primary-color-dark'],
                'isImage' => false,
            ]
        ]);
        ?>
    </div>


</div>

<div class="row">
    <div class="col-12">

        <?

        $scholar->configs->nameOff = [
            'created_at',
            'modified_at',
            'created_by',
            'modified_by',
        ];

        $scholar->configs->readonly = true;
        $scholar->columns();

        echo ZDynaWidget::widget([
            'model' => $scholar,
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
                'title' => Az::l('Cписок стипендиатов'),
                'perfectScrollbar' => true,
                'topCreate' => false,
                'actionEdit' => false,
                'actionDelete' => false,
                'actionClone' => false,
                'actionView' => true,
                'columnAction' => false,
                'columnRelation' => false,
                'topSort' => false,
                'topFilter' => false,
                'topSetting' => false,
                'filter' => false,
                'columnAfter' => false,
                'columnBefore' => [
                    'false'
                ],

            ],
        ]);

        ?>

    </div>

</div>


