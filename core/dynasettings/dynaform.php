<?php


use zetsoft\former\dyna\DynaForm;
use zetsoft\models\dyna\DynaConfig;
use zetsoft\system\actives\ZActiveRecord;
use zetsoft\system\actives\ZAjaxForm;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZFormWidget;


/** @var ZView $this */
$action->type = WebItem::type['ajax'];

$ajaxModel = $this->httpGet('model');
$modelName = str_replace('/', '\\', $ajaxModel);
$name = $this->httpGet('attribute');

/** @var ZActiveRecord $model */

$service = Az::$app->smart->dyna;
$model = new $modelName();
$id = $this->httpGet('id');
$columns = $model->columns;

/*CoreDyna model*/

$coreDyna = DynaConfig::findOne([
    'dynaId' => $id
]);

/* Process and Save POST data to CoreDyna */

if ($this->httpPost('DynaForm')) {

    if (!$coreDyna)
        $coreDyna = new DynaConfig();

    $dynaForm = $this->httpPost('DynaForm');

    if (!empty($coreDyna->column))
        $columns = $service->dynaColumnMerge($coreDyna->column, $columns);

    $dynaArray = $service->getFormDb($dynaForm, $columns, $name);

    $coreDyna->dynaId = $id;
    $coreDyna->column = $dynaArray;

    $coreDyna->save();

}


$form = ZAjaxForm::begin([
    'id' => 'dynaForm',
    'formConfig' => [
        'showLabels' => false,
    ]
]);

$dynaForm = new DynaForm();
$dynaForm->attributes = $service->dataValue($columns, $name, $dynaForm->attributes);

if(!empty($coreDyna->dynaColumns))
    $dynaForm->attributes = $coreDyna->dynaColumns[$name];


echo ZFormWidget::widget([
    'model' => $dynaForm,
    'form' => $form,
    'event' => [
        'buttonClick' => "
    function() {
        $('#saveAllSettings').fadeIn();
    }
"
    ]
]);

ZAjaxForm::end();


