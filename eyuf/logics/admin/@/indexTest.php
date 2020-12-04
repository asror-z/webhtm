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

use kartik\dynagrid\DynaGrid;
use widgets\former\ZDynaTestWidget;
use yii\bootstrap\Modal;
use yii\data\ArrayDataProvider;
use yii\helpers\Html;
use zetsoft\former\eyuf\EyufProgramForm;
use zetsoft\models\ALL\CoreCompany;
use zetsoft\models\ALL\CoreCountry;
use zetsoft\models\ALL\CoreRole;
use zetsoft\models\user\User;
use zetsoft\models\App\eyuf\EyufCompatriot;
use zetsoft\models\App\eyuf\Program;
use zetsoft\models\App\eyuf\EyufScholar;
use zetsoft\system\actives\ZArrayQuery;
use zetsoft\system\assets\ZColor;
use zetsoft\system\column\ZKDataColumn;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZArray4Widget;
use zetsoft\widgets\former\ZDynaArrayGridWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
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


$model = User::findOne($this->userIdentity()->id);

//vdd(EyufScholar::program);
/** @var ZView $this */
$user = $this->userIdentity();

$scholar = new EyufScholar();

if ($model !== null) {

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
} else {

    $this->urlRedirect('/');
}

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
                'headerTitle' => 'Магистратура',
                'bodyTitle' => $masters,
                'bodyText' => 'Данное время обучаются',
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
        //    firstCard
        echo ZAdminCardWidget::widget([
            'config' => [
                'textPosition' => ZAdminCardWidget::textPosition['textLeft'],
                'isCardHeader' => true,
                'cardTitleBool' => true,
                'headerTitle' => 'Докторантура',
                'bodyTitle' => $doctors,
                'bodyText' => 'Данное время обучаются',
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
        //    firstCard
        echo ZAdminCardWidget::widget([
            'config' => [
                'textPosition' => ZAdminCardWidget::textPosition['textLeft'],
                'isCardHeader' => true,
                'cardTitleBool' => true,
                'headerTitle' => 'Повышение квалификации',
                'bodyTitle' => $qualify,
                'bodyText' => 'Данное время обучаются',
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

    <div class="col-lg-3 col-md-6">
        <?php
        //    firstCard
        echo ZAdminCardWidget::widget([
            'config' => [
                'textPosition' => ZAdminCardWidget::textPosition['textLeft'],
                'isCardHeader' => true,
                'cardTitleBool' => true,
                'headerTitle' => 'Стажировка',
                'bodyTitle' => $intern,
                'bodyText' => 'Принято заявок',
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
</div>
<h4 class="ml-4 mt-5"></h4>
<div class="row">
    <div class="col-12">

        <?

        echo ZDynaTestWidget::widget([
            'model' => $scholar,

        ]);

        ?>

    </div>
</div>
<style>
    .fa-size{
        font-size: 60px !important;
        margin-left: 24px !important;
    }
    .card-icon {
        margin-bottom: 15px !important;
    }
    .titleText{
        font-size:55px !important; ;
    }
</style>









