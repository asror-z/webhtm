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

use zetsoft\dbitem\core\WebItem;
use zetsoft\former\eyuf\EyufProgramForm;
use zetsoft\models\ALL\CoreCompany;
use zetsoft\models\ALL\CoreCountry;
use zetsoft\models\ALL\CoreRole;
use zetsoft\models\App\eyuf\Program;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\charts\ZChartFormWidget;

//use zetsoft\widgets\themes\ZAdminCardWidget;

/** @var ZView $this */
$action = new WebItem();

$action->layout = true; $action->debug = false;
$action->icon = 'fa fa-graduation-cap';


$action->title = Azl . 'Статистика';

?>

<center>
    <h1 style="font-weight: bold; font-size: 25px">Статистика  <i class="fas fa-chart-bar"></i> </h1>
</center>


<iframe src="/eyuf/cores/main/table.aspx"
        width="100%"
        height="700"
        scrolling="no"
        style="border: none !important"
></iframe>
<?php
$forms = new EyufProgramForm();
$action->title = Azl . 'Статистика в формате стран по программам';
/** @var ZView $this */

/*$data = Az::$app->App->eyuf->main->formByCountries($forms);*/

$data = Az::$app->App->eyuf->main->formByCountries($forms);

/*vdd($forms->columnsList());*/

echo ZChartFormWidget::widget([
    'model' => $forms,
    'data' => $data ,
    'config' => [
        'type' => ZChartFormWidget::type['bar'],
        'title' => Az::l('Статистика в формате стран по программам'),
        'startValue' => 0,
        'endValue' => 10,
        'theme' => ZChartFormWidget::theme['shine']
    ]

]);
?>




