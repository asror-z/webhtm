<?php
/** @var ZView $this */

use zetsoft\dbitem\core\WebItem;
use zetsoft\former\eyuf\EyufProgramForm;
use zetsoft\former\eyuf\RavshanForm;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZDynaWidgetBbbb;
use zetsoft\widgets\notifier\ZModalNewWidget;
use zetsoft\widgets\themes\ZAdminCardWidget;


$action = new WebItem();

$action->title = Azl . 'Главная страница';
$action->icon = 'fal fa-print';
$action->layout = true;
$action->debug = false;

$this->paramSet(paramAction, $action);

$this->title();

$this->toolbar();


?>
<div class="row" style="margin-bottom: -30px!important;">
    <div class="col-lg-4 col-md-6">
        <script>
            $(document).ready(function () {
                $(".cardContent").click(function () {
                    $("#myModal").modal('show');
                });
            });
        </script>

        <?php

        if ($this->userIsGuest()) {

            ZModalNewWidget::begin([
                'id' => 'myModal',
                'config' => [
                    'title' => Az::l('Вход в систему'),
                    'size' => ZModalNewWidget::size['lg']
                ]
            ]);

            ?>

            <div class="col-lg-12 col-md-8 col-sm-6" style="overflow: hidden;">
                <iframe src="/eyuf/cores/auth/login-frame.aspx" height="600" width="100%" class="border-0"
                        scrolling="no"></iframe>
            </div>

            <?

            ZModalNewWidget::end();
        }

        //    firstCard
        echo ZAdminCardWidget::widget([
            'config' => [
                'textPosition' => ZAdminCardWidget::textPosition['textLeft'],
                'isCardHeader' => false,
                'cardTitleBool' => true,
                'headerTitle' => '',
                'bodyTitle' => ' ',
                'bodyText' => Az::l('Фонд Эл-юрт умиди'),
                'footerColor' => ZColor::color['primary-color-dark'],
                'footerText' => '',
                'badgeBgColor' => ZColor::color['stylish-color-dark'],
                'badge' => '',
                'horizontal_OR_vertical' => 'vertical',
                'cardWidth' => '100%',
                'color' => ZColor::color['primary-color'],
                'icon' => '/render/theme/ZAdminCardWidget/icons/logo_w.png',
                'isImage' => true,
                'align' => ZAdminCardWidget::align['center'],
            ]
        ]);
        ?>
    </div>

    <div class="col-lg-4 col-md-6">
        <?php

        //        fourth Card
        echo ZAdminCardWidget::widget([
            'config' => [
                'textPosition' => ZAdminCardWidget::textPosition['textLeft'],
                'isCardHeader' => false,
                'cardTitleBool' => true,
                'headerTitle' => '',
                'bodyTitle' => '',
                'bodyText' => Az::l('Стипендиант'),
                'footerColor' => ZColor::color['primary-color-dark'],
                'footerText' => '',
                'badgeBgColor' => ZColor::color['stylish-color-dark'],
                'badge' => '',

                'horizontal_OR_vertical' => 'vertical',
                'cardWidth' => '100%',
                'color' => ZColor::color['primary-color'],
                'icon' => '/render/theme/ZAdminCardWidget/icons/student_w.svg',
                'isImage' => true,
                'align' => ZAdminCardWidget::align['center'],
            ]
        ]);
        ?>
    </div>
    <div class="col-lg-4 col-md-6">
        <?php

        //      thirtdCard
        echo ZAdminCardWidget::widget([
            'config' => [
                'textPosition' => ZAdminCardWidget::textPosition['textLeft'],
                'isCardHeader' => false,
                'cardTitleBool' => true,
                'headerTitle' => '',
                'bodyTitle' => '',
                'bodyText' => Az::l('Внешниe организации'),
                'footerColor' => ZColor::color['primary-color-dark'],
                'footerText' => '',
                'badgeBgColor' => ZColor::color['stylish-color-dark'],
                'badge' => '',
                'horizontal_OR_vertical' => 'vertical',
                'cardWidth' => '100%',
                'color' => ZColor::color['primary-color'],
                'icon' => '/render/theme/ZAdminCardWidget/icons/goverment_w.svg',
                'isImage' => true,
                'align' => ZAdminCardWidget::align['center'],
            ]
        ]);
        ?>
    </div>
</div>
<br>
<br>


<!--<iframe src="/eyuf/cores/main/table.aspx"
    width="100%"
    height="700"
    style="border: none"
    ></iframe>-->

<?
$model = new EyufProgramForm();

/** @var ZView $this */

$data = Az::$app->App->eyuf->main->formByCountriesSosya($model);

?>
<div class="mt-3">
    <?php
    $this->pjaxBegin();
    
    echo ZDynaWidget::widget([
        'model' => $model,
        'data' => $data,
        'type' => ZDynaWidget::type['form'],
        'config' => [
            'type' => 'form',
            'hasToolbar' => true,
            'filter'=> false,
            'pjax' => false,
            'columnBefore' => [''],
            'actionButtons' => false,
            'columnAfter' => ['checkbox'],
            'showPageSummary' => false,
            'createTitle' => Az::l('Создание прихода в склад')
        ],
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
                'content' => '{clone}{delete}',
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

            'toggleData' => [
                'content' => '',
                'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
            ],
        ],
    ]);
    $this->pjaxEnd();
    ?>
</div>
