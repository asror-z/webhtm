<?php


use zetsoft\dbitem\core\WebItem;
use zetsoft\former\dyna\DynaForm;
use zetsoft\models\dyna\DynaConfig;
use zetsoft\service\forms\Active;
use zetsoft\service\forms\Ajaxer;
use zetsoft\system\actives\ZActiveData;
use zetsoft\system\actives\ZActiveRecord;
use zetsoft\system\actives\ZAjaxForm;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\former\ZListWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\widgets\themes\ZTabForDynaWidget;


/** @var ZView $this */
$action = new WebItem();

$action->type = WebItem::type['ajax'];
$action->debug = false;

$this->paramSet(paramAction, $action);
$this->paramSet('widget', true);

$modelGet = $this->httpGet('model');
$modelName = $this->bootFull($modelGet);
$name = $this->httpGet('attribute');

/** @var ZActiveRecord $model */


$service = Az::$app->smart->dyna;
$model = new $modelName();

$model->kernel();
$columns = $model->columns;

$dynaId = $this->httpGet('dynaId');
$coreDyna = DynaConfig::findOne([
    'dynaId' => $dynaId,
    'active' => true,
]);

$dynaForm = $this->httpPost('DynaForm');
if ($dynaForm) {

    if (!$coreDyna)
        $coreDyna = new DynaConfig();

    if (!empty($coreDyna->column))
        $columns = $service->columnMerge($coreDyna->column, $columns);

    $dynaArray = $service->getFormDb($dynaForm, $columns, $name);

    $coreDyna->dynaId = $dynaId;
    $coreDyna->column = $dynaArray;
    $coreDyna->active = true;

    $coreDyna->save();

}

$active = new Ajaxer();
$active->id = 'dynaForm';

$form = $this->ajaxBegin($active);

$dynaForm = new DynaForm();

$dynaForm->kernel();
$attributes = $service->dataValue($columns, $name, $model);
$dynaForm->attributes = $attributes;

if (!empty($coreDyna->column))
    $dynaForm->attributes = ZArrayHelper::getValue($coreDyna->column, $name);



echo ZFormBuildWidget::widget([
    'model' => $dynaForm,
    'form' => $form,
    'config' => [
        'topBtn' => false,
    ],
    'event' => [
        'formChange' => <<<JS
    function() {
        $(this).submit()
    }
JS,
    ]
]);

$this->ajaxEnd();

$url = ZUrl::to([
    'dynaform',
    'model' => $this->httpGet('model'),
    'dynaId' => $this->httpGet('dynaId'),
    'attribute' => $this->httpGet('attribute'),
]);

?>

<script>

    $('#dynaForm').on('change', function () {

        $.ajax({
            method: 'POST',
            url: '<?=$url?>',
            data: $(this).serialize(),
        })

    })

</script>
 


