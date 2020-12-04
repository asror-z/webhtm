<?php


use zetsoft\former\dyna\DynaForm;
use zetsoft\former\dyna\DynaVisual;
use zetsoft\models\dyna\DynaConfig;
use zetsoft\system\actives\ZActiveRecord;
use zetsoft\system\actives\ZAjaxForm;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\themes\ZCardWidget;


/** @var ZView $this */
$action = new WebItem();

$action->type = WebItem::type['ajax'];


/** @var ZActiveRecord $model */
$modelName = str_replace('/', '\\', $this->httpGet('model'));
$model = new $modelName();
$columns = $model->columns;

$id = $this->httpGet('id');
$coreDyna = DynaConfig::findOne([
    'dynaId' => $id
]);

if ($this->httpPost('DynaVisual')) {

    if (!$coreDyna)
        $coreDyna = new DynaConfig();

    $dynaForm = $this->httpPost('DynaVisual');

    $coreDyna->dynaId = $id;
    $coreDyna->config = $dynaForm;

    $coreDyna->save();

}

ZCardWidget::begin([
    'config' => [
        'title' => 'DynaGrid Settings',
        'padding' => '30px',
        'type' => ZCardWidget::type['dynCard'],
    ]
]);

$form = ZAjaxForm::begin([
    'id' => 'visualDyna'
]);

$dynaForm = new DynaVisual();
if (!empty($coreDyna->config))
    $dynaForm->attributes = $coreDyna->config;


echo ZFormWidget::widget([
    'model' => $dynaForm,
    'form' => $form,
    'config' => [
        'topBtn' => false
    ],
    'event' => [
        'buttonClick' => "
    function() {
        $('#saveAllSettings').fadeIn();
    }
"
    ]
]);

ZAjaxForm::end();

ZCardWidget::end();

?>

<script>

    $(document).on('change', 'input[type="text"]', function (e) {
        $('#dynaform').click();
    });
</script>

