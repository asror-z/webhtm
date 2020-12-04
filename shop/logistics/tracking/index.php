<?php
/** Author: Zoirjon Sobirov*
 * @zoirjon_sobirov in @ll social media
 *
 */

use kartik\builder\Form;
use yii\data\Pagination;
use zetsoft\dbitem\core\WebItem;
use zetsoft\models\maps\MapsTrack;
use zetsoft\service\forms\Active;
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
use yii\widgets\LinkPager;
use zetsoft\widgets\places\ZGoogleZoirNavigation;
use zetsoft\widgets\places\ZGoogleZoirNavigationUpdated;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();
//Отслеживание товаров

$action->title = Azl . 'Отслеживание товаров';
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

$coors1 = Az::$app->market->wares->coordinatesTarget(53);
$orderAddress = $coors1['ordersAdress'];


/*$waresAddress = $coors1['waresAddress'];*/

?>


<div class="row">
  <div class="col-md-12 col-12 position-relative">

      <?

      $active = new Active();


      $active->type = Active::type['horizontal'];
      $active->enableLabel = false;
      $form = $this->activeBegin($active);

      /*echo ZFormWidgetJ::widget([
          'model' => $model,
          'form' => $form,
          'rows' => [
              [
                  'attributes' => [
                      'jsonb_6' => [
                          'type' => Form::INPUT_WIDGET,
                          'widgetClass' => \zetsoft\widgets\places\ZGoogleZoirReadyNavigation::className(),
                          'options' => [
                              'config' => [
                                  'data' => [3,9,18,65],
                                  'height' => 500,
                                  'width' => 800,
                                  'searchAutoComplete' => true,
                                  'searchPlaceImageShow' => false,
                                  'zoom' => 12,
                                  'markerCount' => 5,
                                  'limitWayPoints' => 10,
                                  'draggable' => true,
                                  'mapUseType' => 'read',
                                  'depend' => 'coreinput-string_9',
                                  'orderAddress' => $orderAddress,
                                 /* 'waresAddress' => $waresAddress */
      /*   ]
     ]
 ],
]
],


],

]);  */
      echo ZFormWidget::widget([
          'model' => $model,
          'form' => $form,
          'rows' => [
              [
                  'attributes' => [
                      'jsonb_6' => [
                          'type' => Form::INPUT_WIDGET,
                          'widgetClass' => ZGoogleZoirNavigationUpdated::className(),
                          'options' => [
                              'config' => [
                                  'data' => [130, 131, 140],
                                  //'data'                 => file_get_contents("/api/core/app/service.aspx?namespace=market&service=wares&method=coordinates&args=24"),
                                  'height' => 500,
                                  'width' => 800,
                                  'searchAutoComplete' => true,
                                  'searchPlaceImageShow' => false,
                                  'zoom' => 12,
                                  'markerCount' => 5,
                                  'limitWayPoints' => 10,
                                  'draggable' => true,
                                  'mapUseType' => 'read',
                                  'depend' => 'coreinput-string_9',
                              ]
                          ]
                      ],
                  ]
              ],


          ],

      ]);
      $this->activeEnd();
      ?>

  </div>
</div>

