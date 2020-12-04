<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\menus\ZMmenuWidgetSh;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\user\UserCompany;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Организации';
$action->icon = 'fal fa-industry';
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
  <div class="col-md-12 col-12">

      <?
      $this->pjaxBegin();
      $model = new UserCompany();
      $model->configs->nameOn = [
          'name',
          'text_short',
          'phone',
          'inn',
          'type',
      ];
      $model->columns();
      /** @var ZView $this */
      echo ZDynaWidget::widget([
          'model' => $model,
          'config' => [
              'pjax' => false,
              'actionButtons' => [
                  'update',
                  'delete',
                  'view',
              ],
              'columnBefore' => [
                  'serial',
                  'sort',
                  'checkbox',
                  paramAction,
                  'relation'

              ],
              'columnAfter' => ['false']
          ]
      ]);
      $this->pjaxEnd();
      ?>

  </div>
</div>


