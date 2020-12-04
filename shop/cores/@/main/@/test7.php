<?php
/** @var ZView $this */

use zetsoft\former\eyuf\EyufProgramForm;
use zetsoft\former\eyuf\RavshanForm;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZArrayWidget;
use zetsoft\widgets\notifier\ZModalNewWidget;
use zetsoft\widgets\themes\ZAdminCardWidget;


$this->cache = true;
$action->debug = true;

?>
<div class="row" style="margin-bottom: -30px!important;">
    <div class="col-lg-4 col-md-6">
        <script>
            $(document).ready(function () {
                //при нажатию на любую кнопку, имеющую класс .btn
                $(".cardContent").click(function () {
                    //открыть модальное окно с id="myModal"
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
                <iframe src="/shop/cores/auth/login-frame.aspx" height="600" width="100%" class="border-0"
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
                'headerTitle' => 'headerTitle',
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
                'headerTitle' => 'headerTitle',
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
                'headerTitle' => 'headerTitle',
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


<!--<iframe src="/cores/main/table.aspx"
    width="100%"
    height="700"
    style="border: none"
    ></iframe>
-->
<?
$action->title = Azl . 'Статистика в формате стран по программам';



$model = new EyufProgramForm();

/** @var ZView $this */
$model->configs->filter = true;
$model->configs->pageSummary = true;

$data = Az::$app->App->eyuf->main->formByCountries($model);

//$this->modelPost();

echo ZArrayWidget::widget([
    'model' => $model,
    'data' => $data,
    'config' => [
        'title' => Az::l('Статистика в формате стран по программам'),
        'exportBtn' => Az::$app->forms->export->run($model, $data),
        'columnCheckbox' => false,
    ]
]);

?>

