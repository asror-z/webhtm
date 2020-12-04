<?php

use zetsoft\dbitem\shop\ProductItem;
use zetsoft\former\dyna\DynaSorting;
use zetsoft\models\dyna\DynaConfig;
use zetsoft\service\forms\Active;
use zetsoft\service\forms\Ajaxer;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\inputes\ZKSortableInputWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\dbitem\core\WebItem;
use zetsoft\system\kernels\ZWidget;

/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Главная страница';
$action->icon = 'fas fa-area-chart';
$action->type = WebItem::type['ajax'];
$action->csrf = true;
$action->debug = false;

$action->cache = false;
$action->cacheHttp = false;

$this->paramSet(paramAction, $action);
$this->paramSet('widget', true);


/** @var ZView $this */

$service = Az::$app->smart->dyna;
$modelName = $this->bootFull($this->httpGet('model'));
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

$visibleCol = $service->getVisibleColumns($model);
$hiddenCol = $service->getHiddenColumns($visibleCol, $model);

$ajaxer = new Ajaxer();
$ajaxer->formAction = '';
$formModel = new DynaSorting();

$this->ajaxBegin($ajaxer);

?>
<div class="row">

   <div class="col-sm-6">
       <?php

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

$this->ajaxEnd();
?>

<style>
    #sortingSubmit {
        visibility: hidden;
    }
</style>
