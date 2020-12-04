<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\system\actives\ZActiveRecord;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\shop\ShopDelay;



/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Перенос даты доставки';
$action->icon = 'fal fa-certificate';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = false;



$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();



/**
 *
 * Start Page
 */

$this->beginPage();
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>

    <?php

    require Root . '/webhtm/block/metas/main.php';
    require Root . '/webhtm/block/assets/main.php';

    $this->head();

    ?>

</head>


<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php

$this->beginBody();

echo ZNProgressWidget::widget([]);
if (!$this->httpGet('spa'))
    echo ZMmenuWidget::widget();
?>

<div id="page">

    <?

    require Root . '/webhtm/block/navbar/admin.php';

    echo ZSessionGrowlWidget::widget();?>

  <div id="content" class="content-footer p-3">




    <div class="row">
      <div class="col-md-12">

          <?
          /** @var ZActiveRecord $model */
          $model = new ShopDelay();
          $model->configs->showDeleted = true;
          $model->configs->nameOn = [
              'id',
              'name',
              'deleted_at',
              'deleted_by',
              'deleted_text',
          ];

          $model->columns();



          /** @var ZView $this */
          echo ZDynaWidget::widget([
              'rightBtn'=>[
                  'update' => [
                      'content' => '{update}',
                      'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                  ],
                  'clear_update' => [
                      'content' => '{clear_update}',
                      'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                  ],

                  'system' => [
                      'content' => '{system}{delDyna}',
                      'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                  ],

                  'add-clone-delete' => [
                      'content' => '{choose}{add}{tabular}{clone}{delete}',
                      'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                  ],

                  'filter-sort-id' => [
                      'content' => '{dynagridFilter}{filter}{dynagridSort}{dynagridSettings}{dynagrid}',
                      'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                  ],

                  'statistics' => [
                      'content' => '{statistics}{report}',
                      'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                  ],

                  'export' => [
                      'content' => '',
                      'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
                  ],


                  'toggleData' => [
                      'content' => '{all}',
                      'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
                  ],
              ],
              'model' => $model,
              'config' => [
                  'columnBefore' => [
                      'checkbox',
                  ],
                  'columnAfter' => false,
                  'actionButtons' => false
              ]
          ]);

          ?>

      </div>
    </div>


  </div>
    <?= $this->require( '\webhtm\block\footer\footerAdmin.php') ?>
</div>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
