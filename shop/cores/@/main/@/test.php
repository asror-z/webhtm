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
                'BadgeBgColor' => ZColor::color['stylish-color-dark'],
                'badge' => '',

                'horizontal_OR_vertical' => 'vertical',
                'cardWidth' => '100%',
                'color' => ZColor::color['primary-color'],
                'Icon' => '/render/Menus/ALL/MMenu/icons/logo_w.png',
            ]
        ]);
        ?>
    </div>
    <!--
    <div class="col-lg-4 col-md-6">
        <?php
    /*        //       secondCard
            echo ZAdminCardWidget::widget([
                'config' => [
                    'textPosition' => ZAdminCardWidget::textPosition['textLeft'],
                    'isCardHeader' => false,
                    'cardTitleBool' => true,
                    'headerTitle' => 'headerTitle',
                    'bodyTitle' => '',
                    'bodyText' => 'Министерство, учреждение или организация',
                    'footerColor' => ZColor::color['primary-color-dark'],
                    'footerText' => '',
                    'BadgeBgColor' => ZColor::color['stylish-color-dark'],
                    'badge' => '',

                    'horizontal_OR_vertical' => 'vertical',
                    'cardWidth' => '100%',
                    'color' => ZColor::color['primary-color'],
                    'Icon' => '/render/Menus/ALL/MMenu/icons/goverment_w.svg',
                ]
            ]);
            */ ?>
    </div>
-->
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
                'bodyText' =>Az::l('Стипендиант'),
                'footerColor' => ZColor::color['primary-color-dark'],
                'footerText' => '',
                'BadgeBgColor' => ZColor::color['stylish-color-dark'],
                'badge' => '',

                'horizontal_OR_vertical' => 'vertical',
                'cardWidth' => '100%',
                'color' => ZColor::color['primary-color'],
                'Icon' => '/render/Menus/ALL/MMenu/icons/student_w.svg',
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
                'BadgeBgColor' => ZColor::color['stylish-color-dark'],
                'badge' => '',

                'horizontal_OR_vertical' => 'vertical',
                'cardWidth' => '100%',
                'color' => ZColor::color['primary-color'],
                'Icon' => '/render/Menus/ALL/MMenu/icons/goverment_w.svg',
            ]
        ]);
        ?>
    </div>
</div>
<br>
<br>




<iframe src="/cores/main/table.aspx" height="750" width="100%"
        class="border-0"></iframe>
