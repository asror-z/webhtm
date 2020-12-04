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

use widgets\former\ZDynaTestWidget;
use zetsoft\models\App\eyuf\EyufScholar;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZDynaWidget;
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
                'textPosition' => ZAdminCardWidget::textPosition['textLeft'],
                'isCardHeader' => true,
                'cardTitleBool' => true,
                'headerTitle' => Az::l('Магистратура'),
                'bodyTitle' => $masters,

                'color' => ZColor::color['primary-color'],
                'Icon' => 'fas fa-graduation-cap fa-size',
                'IconColor' => ZColor::color['teal'],
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
                'textPosition' => ZAdminCardWidget::textPosition['textLeft'],
                'isCardHeader' => true,
                'cardTitleBool' => true,
                'headerTitle' => Az::l('Докторантура'),
                'bodyTitle' => $doctors,

                'color' => ZColor::color['primary-color'],
                'Icon' => 'fas fa-user-graduate fa-size',
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
                'textPosition' => ZAdminCardWidget::textPosition['textLeft'],
                'isCardHeader' => true,
                'cardTitleBool' => true,
                'headerTitle' => Az::l('Стажировка'),
                'bodyTitle' => $intern,

                'color' => ZColor::color['primary-color'],
                'Icon' => 'fas fa-user-tie fa-size ',
                'IconColor' => ZColor::color['teal'],
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
                'textPosition' => ZAdminCardWidget::textPosition['textLeft'],
                'isCardHeader' => true,
                'cardTitleBool' => true,
                'headerTitle' => Az::l('Повышение квалификации'),
                'bodyTitle' => $qualify,

                'color' => ZColor::color['primary-color'],
                'Icon' => 'fas fa-user fa-size',
                'IconColor' => ZColor::color['black'],
                'footerText' => '',
                'badge' => '',
                'footerColor' => ZColor::color['primary-color-dark'],
            ]
        ]);
        ?>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <!--       <iframe src="/logics/admin/table.aspx"
           width="100%"
           height="700"
           style="border: none"
           ></iframe>
       -->
        <?
        $scholar = new EyufScholar();

        echo ZDynaWidget::widget([
            'model' => $scholar,
        ]);
        ?>
    </div>
</div>

<style>

    .fa-size {
        font-size: 60px !important;
        margin-left: 24px !important;
    }

    .card-icon {
        margin-bottom: 15px !important;
    }

    .titleText {
        font-size: 55px !important;
    }

    .col-lg-3, .col-md-6 {
        padding-right: 0px;
        padding-left: 10px;
    }
</style>









