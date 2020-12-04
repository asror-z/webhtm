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
use zetsoft\former\eyuf\EyufProgramForm;
use zetsoft\models\ALL\CoreCompany;
use zetsoft\models\ALL\CoreCountry;
use zetsoft\models\ALL\CoreRole;
use zetsoft\models\user\User;
use zetsoft\models\App\eyuf\EyufCompatriot;
use zetsoft\models\App\eyuf\Program;
use zetsoft\models\App\eyuf\EyufScholar;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\charts\ZChartFormWidget;
use zetsoft\widgets\former\ZDynaArrayGridWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\themes\ZAdminCardWidget;
use zetsoft\dbitem\core\WebItem;

/** @var ZView $this */

$action = new WebItem();

$action->title = Azl . 'Статистика';
$action->icon = 'fal fa-print';


$action->layout = true; $action->debug = false;


$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();?>

<center>
    <h1 style="font-weight: bold; font-size: 25px">Статистика  <i class="fas fa-chart-bar"></i> </h1>
</center>

<?php
$forms = new EyufProgramForm();


$action->title = Azl . 'Статистика в формате стран по программам';

/** @var ZView $this */
$data = Az::$app->App->eyuf->main->formByCountries($forms);

/*vdd($forms->columnsList());*/

echo ZChartFormWidget::widget([
    'model' => $forms,
    'data' => $data ,
    'config' => [
        'type' => ZChartFormWidget::type['bar'],
        'title' => 'Статистика в формате стран по программам',
        'startValue' => 0,
        'endValue' => 10,
        'theme' => ZChartFormWidget::theme['shine']
    ]

]);
?>

<iframe src="/cores/main/table.aspx"
        width="100%"
        height="700"
        scrolling="no"
></iframe>


