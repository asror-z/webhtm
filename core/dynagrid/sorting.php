<!--<style>
    #dynasorting-hidden-sortable{
        position: fixed;
        width: 46%;
    }
</style>-->
<?php

use kartik\builder\Form;
use zetsoft\dbitem\data\ConfigDB;
use zetsoft\former\dyna\DynaSorting;
use zetsoft\models\dyna\DynaConfig;
use zetsoft\service\forms\Ajaxer;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\system\module\Models;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\inputes\ZKSortableInputWidget;
use zetsoft\dbitem\core\WebItem;

/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Главная страница';
$action->icon = 'fas fa-area-chart';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = false;

$action->cache = false;
$action->cacheHttp = false;

$this->paramSet(paramAction, $action);
$this->paramSet('widget', true);


/** @var ZView $this */

$service = Az::$app->smart->dyna;
$modelName = $this->bootFull($this->httpGet('model'));
$dynaId = $this->httpGet('dynaId');
$model = new $modelName();

/** @var Models $model */
$model->kernel();

$coreDyna = DynaConfig::findOne([
    'dynaId' => $dynaId,
    'active' => true
]);

$postSorting = $this->httpPost('DynaSorting');
if ($postSorting) {

    if (!$coreDyna)
        $coreDyna = new DynaConfig();

    $string = ZArrayHelper::getValue($postSorting, 'visible');
    $array = explode(',', $string);

    $coreDyna->sort = $array;
    $coreDyna->dynaId = $dynaId;
    $coreDyna->active = true;
    $coreDyna->save();

}

/** @var ConfigDB $configs */
$configs = new ConfigDB();

//$configs = json_decode($configs, true, 512);

$configs = $service->getConfigDbItem($configs);
/*$columns = $service->getColumnsDbItem($columns);*/
$visibleCol = $service->getVisibleColumns($model, $configs->nameOn, $configs->nameOff);

if ($coreDyna) {
    if (!empty($coreDyna->sort))
        $visibleCol = $service->getVisibleColumnsFromTable($coreDyna->sort, $model);
}

$hiddenCol = $service->getHiddenColumns($visibleCol, $model);

$active = new Ajaxer();
$active->id = 'sortingDyna';

$form = $this->ajaxBegin($active);

$formModel = new DynaSorting();
$formModel->configs->hasLabel = false;
$formModel->kernel();

echo ZFormWidget::widget([
    'model' => $formModel,
    'form' => $form,
    'config' => [
        'topBtn' => false,
        'botBtn' => false,
    ],
    'rows' => [
        [
            'attributes' => [

                'visible' => [
                    'type' => Form::INPUT_WIDGET,
                    'widgetClass' => ZKSortableInputWidget::class,
                    'options' => [
                        'data' => $visibleCol
                    ]
                ],

                'hidden' => [
                    'type' => Form::INPUT_WIDGET,
                    'widgetClass' => ZKSortableInputWidget::class,
                    'options' => [
                        'data'  => $hiddenCol,
                    ]
                ],

            ]
        ],
    ]
]);

$this->ajaxEnd();
?>

<script>

    $('#sortingDyna').on('change', function () {

        $.ajax({
            method: 'POST',
            url: 'sorting.aspx?model=<?=$this->httpGet('model')?>&dynaId=<?=$this->httpGet('dynaId')?>',
            data: $(this).serialize(),
        })

    })

</script>
