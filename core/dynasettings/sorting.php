<?php


use kartik\widgets\ActiveForm;
use zetsoft\dbitem\core\WebItem;
use zetsoft\former\dyna\DynaSorting;
use zetsoft\models\dyna\DynaConfig;
use zetsoft\system\actives\ZAjaxForm;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\inputes\ZKSortableInputWidget;
use zetsoft\widgets\navigat\ZButtonWidget;

/** @var ZView $this */
$action = new WebItem();
$action->type = WebItem::type['ajax'];
$action->debug = false;

$modelName = str_replace('/', '\\', $this->httpGet('model'));
$model = new $modelName();


$id = $this->httpGet('id');
$coreDyna = DynaConfig::findOne([
    'dynaId' => $id
]);

if ($this->httpPost('DynaSorting')) {

    if (!$coreDyna)
        $coreDyna = new DynaConfig();

    $string = ZArrayHelper::getValue($this->httpPost('DynaSorting'), 'visible');

    $array = explode(',', $string);

    $coreDyna->sort = $array;
    $coreDyna->dynaId = $id;
    $coreDyna->save();

}

$formModel = new DynaSorting();

$visibleCol = json_decode($this->httpGet('columns'), true);
$hiddenCol = json_decode($this->httpGet('hidden'), true);

$this->activeBegin();

?>
<div class="row">

   <div class="col-sm-6">
       <?

       echo ZKSortableInputWidget::widget([
           'data' => $visibleCol,
           'model' => $formModel,
           'attribute' => 'visible',
           'event' => [
                'sortUpdate' => "
                    function() {
                        $('#sortingSubmit').click();
                    }
                "
           ]
       ]);

       ?>
   </div>

   <div class="col-sm-6">
       <?

       echo ZKSortableInputWidget::widget([
           'data' => $hiddenCol,
           'model' => $formModel,
           'attribute' => 'hidden',
           'event' => [
               'sortUpdate' => "
                    function() {
                        $('#sortingSubmit').click();
                    }
                "
           ]
       ]);

       ?>
   </div>
</div>


<?

echo ZButtonWidget::widget([
      'id' => 'sortingSubmit',
      'config' => [
          'hidden' => true,
          'btnType' => ZButtonWidget::btnType['submit'],
      ]
]);
$this->activeEnd();

?>

<style>
    #sortingSubmit {
        visibility: hidden;
    }
</style>
