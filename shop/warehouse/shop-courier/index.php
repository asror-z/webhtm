<?php

use yii\web\NotFoundHttpException;
use zetsoft\dbdata\App\market\RoleData;
use zetsoft\dbitem\core\WebItem;
use zetsoft\models\shop\ShopCourier;
use zetsoft\models\test\TestTerrabayt;
use zetsoft\system\helpers\ZInflector;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\system\module\Models;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZDynaWidgetAs;
use zetsoft\widgets\former\ZDynaWidgetRav;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\menus\ZMmenuWidgetSh;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\user\User;


/** @var ZView $this */


/**
 *
 * Action Params
 */


/** @var Models $model */


$this->beginPage();


$action = new WebItem();

$action->icon = 'fal fa-graduation-cap';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->loader = false;
$action->layout = true;
$action->layoutFile = 'admin';

if ($this->httpGet('spa'))
    $action->debug = false;


$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();
?>


    <div id="content" class="content-footer p-3">


        <div class="row">
            <div class="col-md-12 col-12">

                <?
                $this->pjaxBegin();
                $model = new ShopCourier();
                if ($this->userRole() === 'warehouse_region') {
                    $region = $this->userIdentity()->place_region_id;
                    $model->configs->query = ShopCourier::find()
                        ->where("'place_region_ids'@>$region");
                }

      echo ZDynaWidget::widget([
          'model' => $model,
          'leftBtn' => [
              'status' => [
                  'content' => '',
                  'options' => ['class' => 'mx-3']
              ]
          ],
          'config' => [
              'pjax' => false,
              'updateUrl' => '{fullUrl}/update.aspx?shop_courier_id={id}',
              'viewUrl' => '{fullUrl}/view.aspx?shop_courier_id={id}',
              'actionButtons' => [
                  'update',
                  'delete',
                  'clone',
                  'view',
              ],
              'columnBefore' => [
                  'checkbox',
                  'action',
            ],
              'columnAfter' => false,
          ],
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
                  'content' => '{add}{tabular}{clone}{delete}',
                  'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
              ],

              'filter-sort-id' => [
                  'content' => '{dynagridFilter}{filter}{dynagridSort}{dynagridSettings}{dynagrid}',
                  'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
              ],

              'statistics' => [
                  'content' => '',
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
      ]);

      $this->pjaxEnd();
      ?>

  </div>
</div>



