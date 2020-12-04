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
use zetsoft\models\ALL\CoreUser;
use zetsoft\models\eyuf\Compatriot;
use zetsoft\models\eyuf\Program;
use zetsoft\models\eyuf\Scholar;
use zetsoft\system\assets\ZColor;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZDynaArrayGridWidget;
use zetsoft\widgets\former\ZFormBuilderWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\themes\ZAdminCardWidget;

/** @var ZView $this */
$this->init();

$this->title('Окно модератора');

?>
<?php


$model = CoreUser::findOne($this->userIdentity()->id);

/** @var ZView $this */
$user = $this->userIdentity();
$company = $user->getCoreCompany();

$scholar = new Scholar();

$scholar->configs->edit = false;
$scholar->configs->filter = false;


if ($company !== null) {
    $scholar->configs->query = Scholar::find()->where([
        'core_company_id' => $company->id,
    ]);
        
    $intern = Scholar::find()
        ->where([
                'core_company_id' => $company->id,
                'program' => Scholar::program['intern']]
        )->count();

    $doctors = Scholar::find()
        ->where([
                'core_company_id' => $company->id,
                'program' => Scholar::program['doctors']]
        )->count();

    $masters = Scholar::find()
        ->where([
                'core_company_id' => $company->id,
                'program' => Scholar::program['masters']]
        )->count();

    $qualify = Scholar::find()
        ->where([
                'core_company_id' => $company->id,
                'program' => Scholar::program['qualify']]
        )->count();
} else{
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
                'icon' => 'fas fa-user',
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
                'textPosition' => ZAdminCardWidget::textPosition['textLeft'],
                'isCardHeader' => true,
                'cardTitleBool' => true,
                'headerTitle' => 'Докторантура',
                'bodyTitle' => $doctors,
                'bodyText' => 'Данное время обучаются',
                'color' => ZColor::color['primary-color'],
                'icon' => 'fas fa-user',
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
                'icon' => 'fas fa-user',
                'iconColor' => ZColor::color['black'],
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
                'icon' => 'fas fa-user',
                'iconColor' => ZColor::color['teal'],
                'footerText' => '',
                'badge' => '',
                'footerColor' => ZColor::color['primary-color-dark'],
            ]
        ]);
        ?>
    </div>
</div>
<h4 class="ml-4 mt-5"><?= $company['name'] ?></h4>
<div class="row">
    <div class="col-12">

        <?
        
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
            'config' =>[
                'title' => 'список стипендиатов',
                'topCreate' => false,
                'actionEdit' => false,
                'actionDelete' => false,
                'actionClone' => false,
                'columnAction' => false,
                'columnRelation' => false,
                'topSort' => false,
                'topFilter' => false,
                'topSetting' => false,
            ],
        ]);

        ?>
        
    </div>
</div>


