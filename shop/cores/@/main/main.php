<?php
/** @var ZView $this */

use PhpOffice\PhpSpreadsheet\Shared\OLE\PPS\Root;
use rmrevin\yii\fontawesome\FA;
use rmrevin\yii\fontawesome\FAS;

use yii\authclient\widgets\AuthChoice;
use yii\bootstrap\Modal;
use zetsoft\former\auth\AuthLoginForm;
use zetsoft\former\eyuf\EyufProgramForm;
use zetsoft\models\core\CoreRole;
use zetsoft\system\actives\ZArrayQuery;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\column\ZKDataColumn;
use zetsoft\system\helpers\ZHTML;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZArray4Widget;
use zetsoft\widgets\former\ZArrayWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\notifier\ZModalNewWidget;
use zetsoft\widgets\themes\ZAdminCardWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\widgets\themes\ZColWidget;
use kartik\dynagrid\DynaGrid;
use kartik\grid\DataColumn;
use kartik\grid\GridView;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use zetsoft\former\eyuf\RavshanForm;
use zetsoft\models\place\PlaceCountry;
use zetsoft\models\user\User;

?>
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <script>
                $(document).ready(function () {
                    //при нажатию на любую кнопку, имеющую класс .btn
                    $(".cardContent").click(function () {
                        //открыть модальное окно с id="myModal"
                         $('#login').modal('show')
                    });

                });

            </script>

            <?php


            ZModalNewWidget::begin([
                'id' => 'login',
                'config' => [
                'title' => 'Логин в систему'
                ]
            ]);
            ?>
            <iframe src="/shop/cores/auth/login-frame.aspx"
                    width="500"
                    height="450"
                    scrolling="no"
                    class="border-0"
            ></iframe>
            <?php

            ZModalNewWidget::end();


            //    firstCard

            echo ZAdminCardWidget::widget([
                'config' => [

                    'textPosition' => ZAdminCardWidget::textPosition['textLeft'],
                    'isCardHeader' => false,
                    'cardTitleBool' => true,
                    'headerTitle' => 'headerTitle',
                    'bodyTitle' => ' ',
                    'bodyText' => 'Фонд Эл-юрт умиди',
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
        <div class="col-lg-3 col-md-6">
            <?php
            //       secondCard
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
            ?>
        </div>

        <div class="col-lg-3 col-md-6">
            <?php

            //        fourth Card
            echo ZAdminCardWidget::widget([
                'config' => [
                    'textPosition' => ZAdminCardWidget::textPosition['textLeft'],
                    'isCardHeader' => false,
                    'cardTitleBool' => true,
                    'headerTitle' => 'headerTitle',
                    'bodyTitle' => '',
                    'bodyText' => 'Стипендиант',
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
        <div class="col-lg-3 col-md-6">
            <?php

            //      thirtdCard
            echo ZAdminCardWidget::widget([
                'config' => [
                    'textPosition' => ZAdminCardWidget::textPosition['textLeft'],
                    'isCardHeader' => false,
                    'cardTitleBool' => true,
                    'headerTitle' => 'headerTitle',
                    'bodyTitle' => '',
                    'bodyText' => 'ВУЗ или Научно-иследовательское учреждение',
                    'footerColor' => ZColor::color['primary-color-dark'],
                    'footerText' => '',
                    'BadgeBgColor' => ZColor::color['stylish-color-dark'],
                    'badge' => '',

                    'horizontal_OR_vertical' => 'vertical',
                    'cardWidth' => '100%',
                    'color' => ZColor::color['primary-color'],
                    'Icon' => '/render/Menus/ALL/MMenu/icons/school_w.svg',
                ]
            ]);
            ?>
        </div>
    </div>

    <br>

<?php


$model = new EyufProgramForm();
$action->title = Azl . 'Статистика в формате стран по программам';
/** @var ZView $this */
$data = Az::$app->App->eyuf->main->formByCountries($model);


/*
echo ZArrayWidget::widget([
    'config' => [
        'title' => 'Стипендианты в разрезе стран'
    ],
    'model' => $model,
    'data' => $data
]);
*/



