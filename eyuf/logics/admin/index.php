<?php

/**
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

use widgets\former\ZDynaTestWidget;
use zetsoft\models\App\eyuf\EyufScholar;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\themes\ZAdminCardWidgetOld;
use zetsoft\widgets\themes\ZAdminCardWidget;
use zetsoft\dbitem\core\WebItem;

/** @var ZView $this */

$action = new WebItem();

$action->title = Azl . 'Админ панель';
$action->icon = 'fal fa-print';


$action->layout = true; $action->debug = false;


$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();?>
<?php


/** @var ZView $this */
$user = $this->userIdentity();


$intern = EyufScholar::find()
    ->where([

            'program' => EyufScholar::program['intern']]
    )->count();

$doctors = EyufScholar::find()
    ->where([

            'program' => EyufScholar::program['doctors']]
    )->count();

$masters = EyufScholar::find()
    ->where([

            'program' => EyufScholar::program['masters']]
    )->count();

$qualify = EyufScholar::find()
    ->where([

            'program' => EyufScholar::program['qualify']]
    )->count();

$scholar = new EyufScholar();


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
        //    secondCard
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
            ]
        ]);
        ?>
    </div>

    <div class="col-lg-3 col-md-6">
        <?php
        //    thirdCard
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
            ]
        ]);
        ?>
    </div>

    <div class="col-lg-3 col-md-6">
        <?php
        //    fourthCard
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
                'align' => ZAdminCardWidget::align['center'],
            ]
        ]);
        ?>
    </div>
</div>
<div class="row">
    <div class="col-12">

        <?
        $scholar = new EyufScholar();

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
            
        ]);
        ?>
    </div>
</div>








