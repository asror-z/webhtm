<?php

use Ratchet\App;
use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\data\Config;
use zetsoft\dbitem\data\FormDb;
use zetsoft\models\place\PlaceCountry;
use zetsoft\models\shop\ShopOrder;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZDynaWidgetR;
use zetsoft\widgets\former\ZDynaWidgetRav;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Поступление товаров в склад';
$action->icon = 'fal fa-film';
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

      <?php
      $this->pjaxBegin();
      $model = new PlaceCountry();

      $model->configs->changeSave = true;
      $model->configs->type = ALLData::type['array'];
      $model->configs->editClass = ALLData::editClass['sweetAs'];
      $model->columns();

      /** @var ZView $this */
      echo ZDynaWidget::widget([
          'model' => $model,
          'config' => [
              'pjax' => false,
          ],
      ]);
      $this->pjaxEnd();
      ?>

  </div>
</div>



