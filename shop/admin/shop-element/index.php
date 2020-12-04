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
use zetsoft\models\shop\ShopElement;


/** @var ZView $this */


/**
 *
 * Action Params
 * @author Umid Muminov
 */

$action = new WebItem();

$action->title = Azl . 'Элементы продукта';
$action->icon = 'fal fa-print-slash';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->layout = true;
$action->layoutFile = 'admin';

if ($this->httpGet('spa'))
    $action->debug = true;


$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();


?>


<div class="row">
  <div class="col-md-12 col-12">

      <?
      $this->pjaxBegin();
      $model = new ShopElement();

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
              'spaWidth' => [
                  'create' => '1100px',
                  'view' => '880px'
              ],
              'spaHeight' => [
                  'create' => '660px',
                  'view' => '675px',
              ],
              'columnBefore' => [
                  'serial',
                  'sort',
                  'checkbox',
                  'action',
            ],
              'spaArray' => [
                  'create' => true,
                  'update' => false
              ],
              'columnAfter' => ['false']
          ]
      ]);
      $this->pjaxEnd();
      ?>

  </div>
</div>


