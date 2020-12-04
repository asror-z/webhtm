<?php


use kartik\builder\Form;
use zetsoft\dbitem\core\WebItem;
use zetsoft\former\deps\DepsFilterForm;
use zetsoft\models\dyna\DynaConfig;
use zetsoft\models\dyna\DynaMulti;
use zetsoft\service\forms\Active;
use zetsoft\service\forms\ZPjax;
use zetsoft\system\actives\ZActiveRecord;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\former\ZListWidget;
use zetsoft\widgets\former\ZMultiWidget;
use zetsoft\widgets\inputes\ZHInputWidget;
use zetsoft\widgets\inputes\ZKSelect2Widget;
use zetsoft\widgets\inputes\ZSelect2Widget;
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


$dynaId = Az::$app->forms->dynas->dynaId($this->modelClassName);

$model = DynaMulti::findOne([
    'dynaId' => $dynaId
]);

if ($model === null) {
    $model = new DynaMulti();
    $model->configs->rules = [
        [
            validatorSafe
        ]
    ];
    $model->save();

}

$model->configs->widget = [
    'value' => function ($filterForm) use ($model) {

        /** @var DepsFilterForm $model */

        $modelClass = new $model();

        $widget = ZHInputWidget::class;
        if (!empty($filterForm->attribute)) {
            $column = $modelClass->columns[$filterForm->attribute];
            $widget = $column->widget;
        }

        return $widget;
    }
];

$active = new Active();
$active->id = 'dynaFilterForm';
$form = $this->activeBegin($active);

if ($this->modelSave($model)) {
    //   $this->paramSet(paramIframe, true);
    $this->modelPost();
    //  $this->urlRedirect(['/' . $this->httpGet('url'), 'dynaMulti' => $model->id], false);
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
<h3 class="text-center">Сохранённые фильтры:</h3>
<?php
/*
$data = Az::$app->market->filterForm->getDynaFilterNames();

echo ZKSelect2Widget::widget([
    'data' => $data,
    'name' => 'name',
]);*/

$this->activeEnd();

?>

