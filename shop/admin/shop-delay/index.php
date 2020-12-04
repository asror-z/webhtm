<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\shop\ShopDelay;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\inputes\ZInputWidget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\menus\ZMmenuWidgetSh;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\shop\ShopShipment;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Перенос даты доставки';
$action->icon = 'fal fa-area-chart';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = false;
$action->layout = true;
$action->layoutFile = 'admin';


$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

?>


<div class="row">
  <div class="col-md-12">

      <?
      $this->pjaxBegin();
      $model = new ShopDelay();

      $model->configs->spa = true;
      $model->configs->hasPlaceholder = false;

      $model->columns();

      /** @var ZView $this */
      echo ZDynaWidget::widget([
          'model' => $model,
          'rightBtn' => [
              'update' => [
                  'content' => '{update}',
                  'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
              ],

              'system' => [
                  'content' => '{system}{delDyna}',
                  'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
              ],

              'add-clone-delete' => [
                  'content' => '{choose}{add}{tabular}{delete}',
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
          'config' => [
              'pjax' => false,
              'spaHeight' => [
                  'create' => '525px',
                  'view' => '618px',
              ],
              'spaWidth' => [
                  'create' => '880px',
                  'view' => '880px'
              ],
              'updateUrl' => '{fullUrl}/process.aspx?shop_delay_id={id}',
              'actionButtons' => [
                  'update',
                  'delete',
                  'clone',
                  'view',
              ],
              'columnBefore' => [
                  'serial',
                  'checkbox',
                  'action',
            ],
              'spaArray' => [
                  'create' => true,
                  'update' => false
              ],
              'columnAfter' => [
                  'ads'
              ]
          ]
      ]);
      $this->pjaxEnd();
      ?>

  </div>
</div>


