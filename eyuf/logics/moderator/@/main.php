
<?php

use rmrevin\yii\fontawesome\FA;
use rmrevin\yii\fontawesome\FAS;

use yii\authclient\widgets\AuthChoice;
use yii\bootstrap\Modal;
use zetsoft\former\auth\AuthLoginForm;
use zetsoft\models\ALL\CoreCountry;
use zetsoft\models\ALL\EyufDocument;
use zetsoft\models\App\eyuf\Program;
use zetsoft\models\App\eyuf\EyufScholar;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZHTML;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\themes\ZAdminCardWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\widgets\themes\ZColWidget;

$arr_scholar = EyufScholar::find()->asArray()->all();
$arr_country = CoreCountry::find()->asArray()->all();
$arr_program = Program::find()->asArray()->all();

foreach ($arr_scholar as $key => $value) {

    if (!isset($arrGlav[$value['core_country_id']])) {
        foreach ($arr_country as $val) {
            $arrGlav[$value['core_country_id']] ['Страна'] = $val['name'];

        } //
        foreach ($arr_program as $val1) {
            if ($val1['id'] == $value['program_id']) {
                $arrGlav[$value['core_country_id']] [$val1['name']] = 1;
            } else {
                $arrGlav[$value['core_country_id']] [$val1['name']] = 0;
            }
        }//
    } else {
        foreach ($arr_country as $val) {
            if ($value['core_country_id'] == $val['id']) {
                $arr[$val['name']] = $val['name'];
                $arrGlav[$value['core_country_id']] ['Страна'] = $val['name'];
            }
        }//
        foreach ($arr_program as $val1) {
            if ($val1['id'] == $value['program_id']) {
                if (isset($arrGlav[$value['core_country_id']] [$val1['name']])) {
                    $arrGlav[$value['core_country_id']] [$val1['name']] = $arrGlav[$value['core_country_id']] [$val1['name']] + 1;
                } else {
                    $arrGlav[$value['core_country_id']] [$val1['name']] = 1;
                }
            }
        }//

    }///////////
}
//vdd($arrGlav);

$mag = $dok = $staj = $pov = 0;

foreach ($arrGlav as $items) {

    $mag +=$items['Магистратура'];
    $dok +=$items['Докторантура'];
    $pov +=$items['Повышение квалификации'];
    $staj +=$items['Стажировка'];

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
                'headerTitle' => Az::l('Магистратура'),
                'bodyTitle' => $mag,
                'bodyText' => Az::l('Принято заявок'),
                'color' => ZColor::color['primary-color'],
                'Icon' => 'fas fa-user',
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
                'headerTitle' => Az::l('Докторантура'),
                'bodyTitle' => $dok,
                'bodyText' => Az::l('Принято заявок'),
                'color' => ZColor::color['primary-color'],
                'Icon' => 'fas fa-user',
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
                'headerTitle' => Az::l('Повышение квалификации'),
                'bodyTitle' => $pov,
                'bodyText' => Az::l('Принято заявок'),
                'color' => ZColor::color['primary-color'],
                'Icon' => 'fas fa-user',
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
                'headerTitle' => Az::l('Стажировка'),
                'bodyTitle' => $staj,
                'bodyText' => Az::l('Принято заявок'),
                'color' => ZColor::color['primary-color'],
                'Icon' => 'fas fa-user',
                'IconColor' => ZColor::color['teal'],
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

        <?


        ?>

    </div>
</div>


