<?php


use kartik\builder\Form;
use zetsoft\dbitem\core\WebItem;
use zetsoft\former\deps\DepsFilterForm;
use zetsoft\models\dyna\DynaConfig;
use zetsoft\models\dyna\DynaMulti;
use zetsoft\service\forms\Active;
use zetsoft\system\actives\ZActiveRecord;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\former\ZListWidget;
use zetsoft\widgets\former\ZMultiWidget;
use zetsoft\widgets\inputes\ZKSelect2Widget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\themes\ZCardWidget;

$action = new WebItem();

$action->title = Azl . 'Страны';
$action->icon = 'fal fa-landmark';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = false;



$this->paramSet(paramAction, $action);


/** @var ZActiveRecord $model */
/** @var ZView $this */

$model = new DynaMulti;

//$model = $model::find()->where(['filter' => 'null'])->all();

$active = new Active();
$active->id = 'dynaFilterForm';
$form = $this->activeBegin($active);

if ($this->modelSave($model)) {
    $this->paramSet(paramIframe, true);
    $this->modelPost();
    $this->urlRedirect(['/' . $this->httpGet('url'), 'dynaMulti' => $model->id], false);
}

echo ZFormWidget::widget([
    'model' => $model,
    'form' => $form,
    'config' => [
        'topBtn' => true,
        'botBtn' => false,
    ]
]);

?>
<h3 class="text-center">Сохранённые сартировки:</h3>
<?php
$data = Az::$app->market->filterForm->getDynaFilterNames();

echo ZKSelect2Widget::widget([
    'data' => $data,
    'name' => 'name'
]);

$this->activeEnd();

?>

<script>
    $('#sweet-dyna-btn').click(() => {
        console.log('asdasd')
        $('#dynaFilterForm').submit()
    });
</script>
