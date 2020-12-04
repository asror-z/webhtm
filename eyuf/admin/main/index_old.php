<?php
/** @var ZView $this */

use zetsoft\dbitem\core\WebItem;
use zetsoft\former\eyuf\EyufProgramForm;
use zetsoft\former\eyuf\RavshanForm;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\notifier\ZModalNewWidget;
use zetsoft\widgets\themes\ZAdminCardWidget;

$action = new WebItem();

$action->title = Az::l('Панель Администратора');
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
<br>

<!--<iframe src="/eyuf/cores/main/table.aspx"
    width="100%"
    height="700"
    style="border: none"
    ></iframe>-->

<?

$this->pjaxBegin();

$model = new EyufProgramForm();

/** @var ZView $this */

$data = Az::$app->App->eyuf->main->formByCountries($model);

echo ZDynaWidget::widget([
    'model' => $model,
    'data' => $data,
    'type' => ZDynaWidget::type['form'],
    'config' => [
        'perfectScrollbar' => true,
        'isArray' => true,
        'title' => 'Стипендианты',
        'columnBefore' => [
            'serial'
        ],
        'columnAfter' => false,
        'filter' => false
    ],
    'rightBtn' => [

        'add-clone-delete' => [
            'content' => '{choose}{tabular}'/*'{clone}'*/,
            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
        ],


        /*'add-clone-delete' => [
            'content' => '',
            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
        ],

        */
    ]
]);

$this->pjaxEnd();
?>

