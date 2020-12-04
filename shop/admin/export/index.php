<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZCheckSelectWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\inputes\ZFileInputWidget;
use zetsoft\widgets\inputes\ZHInputWidget;
use zetsoft\widgets\inputes\ZInputBtnWidget;
use zetsoft\widgets\inputes\ZSelect2Widget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\ware\WareAccept;


/** @var ZView $this */


/**
 *
 * Action Params
 */


$action = new WebItem();

$action->title = Azl . 'Приёмка от курьера';
$action->icon = 'fal fa-cube';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;
$action->layout = true;
$action->layoutFile = 'admin';


$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();
?>


<div class="row">
  <div class="col-md-12 col-12">

      <?
      $this->pjaxBegin();
      $model = new WareAccept();


      $model->configs->nameOn = ['created_at', 'id', 'shop_courier_id', 'completed', 'dc_returns_group', 'salary_courier', 'remain', 'status'];
      $model->columns();

      $model->configs->showDyna = ['dc_returns_group' => true];


      echo ZButtonWidget::widget([
          'config' => [
              'text' => 'Приемки',
              'btnType' => ZButtonWidget::btnType['link'],
              'url' => 'donwload.aspx?type=priyomki',
              'btnRounded' => false,
              'btnStyle' => ZButtonWidget::btnStyle['btn-outline-primary']
          ],
      ]);

      echo ZButtonWidget::widget([
          'config' => [
              'text' => 'Заказы операторов',
              'btnType' => ZButtonWidget::btnType['link'],
              'url' => 'donwload.aspx?type=zakazi_operatorov',
              'btnRounded' => false,
              'btnStyle' => ZButtonWidget::btnStyle['btn-outline-primary']
          ],
      ]);

      /** @var ZView $this */
      echo ZDynaWidget::widget([
          'model' => $model,
          'rightBtn' => [
              'system' => [
                  'content' => '',
                  'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
              ],
              'update' => [
                  'content' => '{update}',
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
                  'content' => '{statistics}',
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
              'updateUrl' => '{fullUrl}/process.aspx?ware_accept_id={id}',
              'spaArray' => [
                  'create' => true,
                  'update' => false
              ],
              'spaHeight' => [
                  'create' => '600px',
                  'view' => '750px',
              ],

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
              'columnAfter' => false
          ]
      ]);
      $this->pjaxEnd();
      ?>

  </div>
</div>



