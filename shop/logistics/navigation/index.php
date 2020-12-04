<?php

use kartik\builder\Form;
use zetsoft\dbitem\core\WebItem;
use zetsoft\models\maps\MapsNavigate;
use zetsoft\models\shop\ShopOrder;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\inputes\ZHInputWidget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\menus\ZMmenuWidgetSh;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\shop\ShopShipment;
use zetsoft\widgets\places\ZGoogleDb29WidgetZoir;
use \zetsoft\widgets\places\ZGoogleReadyWidget;
use yii\widgets\LinkPager;
use yii\data\Pagination;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Навигация товаров';
$action->icon = 'fa fa-wifi';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;
$action->layout = true;
$action->layoutFile = 'admin';

$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();


$model = $this->modelGet(\zetsoft\models\core\CoreInput::class, 7);
$items = Az::$app->forms->modelz->data();
?>


<div class="row">


  <div class="col-md-12 col-12">

      <?
      echo ZFormWidget::widget([
          'model' => $model,
          'rows' => [
              [
                  'attributes' => [

                      'jsonb_10' => [
                          'type' => Form::INPUT_WIDGET,
                          'widgetClass' => ZGoogleReadyWidget::className(),
                          'options' => [
                              'config' => [
                                  'data' => [3, 26],
                                  'height' => 500,
                                  'width' => 800,
                                  'searchAutoComplete' => false,
                                  'searchPlaceImageShow' => false,
                                  'zoom' => '12',
                                  'markerCount' => 0,
                                  'limitWayPoints' => 2,
                                  'optimizeWaypoints' => true,
                                  'draggable' => true,
                                  'mapUseType' => 'read',
                              ]
                          ]
                      ],
                  ]
              ],
          ],

      ]);


      ?>

  </div>

</div>
