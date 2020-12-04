<?php

use zetsoft\dbitem\shop\ProductItem;
use zetsoft\former\dyna\DynaSorting;
use zetsoft\models\dyna\DynaConfig;
use zetsoft\service\forms\Active;
use zetsoft\service\forms\Ajaxer;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\inputes\ZKSelect2Widget;
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

$action->call = [
//TagDependency::invalidate()
];
$action->cacheHttp = false;

$this->paramSet(paramAction, $action);
$this->paramSet('widget', true);

$formModel = new DynaSorting();

$ajaxer = new Ajaxer();
$ajaxer->formAction = '';

$this->ajaxBegin($ajaxer);

?>
<div class="row">

   <div class="col-sm-6">
       <?php

       echo ZKSortableInputWidget::widget([
           'data' => [
            '87s',
            'sa123',
            '32s',
            'sadaw',
           ],
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

       echo ZKSelect2Widget::widget([
           'data' => [
            '87s',
            'sa123',
            '32s',
            'sadaw',
           ],
           'name' => 'assad'
       ]);


       echo ZKSelect2Widget::widget([
           'data' => [
            '87s',
            'sa123',
            '32s',
            'sadaw',
           ],
           'name' => 'assdadsadsasad'
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
