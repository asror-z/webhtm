<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\shop\ShopOrder;
use zetsoft\system\Az;
use zetsoft\system\column\ZKDataColumn;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZCardsWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZGetChecksWidget;
use zetsoft\widgets\former\ZPdfSimpleWidget;
use zetsoft\widgets\inputes\ZBootstrapBorderRadioGroupWidget;
use zetsoft\widgets\inputes\ZInputWidget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\menus\ZMmenuWidgetSh;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZJspanelWidgetRavshan;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\shop\ShopShipment;
use zetsoft\widgets\notifier\ZSweetAlert2Widget;
use zetsoft\widgets\values\ZDateFormatWidget;



/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Назначение заказов курьеру';
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

<div id="content" class="content-footer p-3" style="overflow-x: hidden !important;">


  <div class="row">
    <div class="col-md-12 col-12">

        <?php
        $this->pjaxBegin();

        echo ZCardsWidget::widget();

        $model = new ShopShipment();

        ZSweetAlert2Widget::begin([
            
            'config' => [
                'funcName' => 'shipmentOrders',
                'grapes' => false,
                'width' => 'auto',
                'height' => 'auto',
                'begin' => true,
                'allowOutsideClick' => false,
                'showCloseButton' => true,
                'footer' => '',
                'padding' => '0',
            ],
        ]);
        ?>

      <iframe id="shipmentOrders" width="900px" height="700px"></iframe>

        <?php

        ZSweetAlert2Widget::end();

        $model->configs->before = [
            'id' => [
                [
                    'class' => ZKDataColumn::class,
                    'label' => Az::l('Заказы доставки'),
                    'format' => 'raw',
                    'width' => '70px',
                    'value' => function ($model) {
                        $key = ZArrayHelper::getValue($model, 'id');
                        return ZButtonWidget::widget([
                            'id' => 'order-item' . $key,
                            'config' => [
                                'pjax' => 0,
                                'class' => 'ZDynaBTN',
                                'btnRounded' => false,
                                'btn' => false,
                                'src' => '/render/former/ZDynaWidget/assets/img/items.svg',
                                'img' => true,
                                'hasIcon' => false,
                                'icon' => '',
                            ],
                            'event' => [
                                'click' => <<<JS
                                    function () {
                                      shipmentOrders(); 
                                      var iframe = $('#shipmentOrders');
                                      iframe.attr('src', '/core/help/view-orders.aspx?shop_shipment_id={$key}');   
                                    }
JS,
                            ],
                        ]);
                    }
                ]
            ]
        ];

        $model->configs->spa = false;

        $model->configs->nameOn = [
            'id',
            'created_at',
            'code',
            'shop_courier_id',
            'date_deliver',
            'responsible',
        ];

        $akt = ZGetChecksWidget::widget([
            'model' => $model,
            'config' => [
                'url' => ZUrl::to([
                    '/core/word/actOb',
                    'type' => 'multiGenerateAct',
                    'attribute' => 'status_logistics',
                    'modelClassName' => $model->className,
                    'requiredClassName' => 'ShopOrder',
                    'value' => 'shipment_ready',
                ]),
                'noConfirm' => true,
                'btnOptions' => [
                    'config' => [
                        'btn' => false,
                        'text' => Az::l('Акт передачи'),
                        'btnStyle' => 'btn btn-micro fp-14 text-nowrap text-muted pt-2',
                        'attribute' => 'status',
                        'btnRounded' => true,
                        'class' => 'simple-ShopOrder text-nowrap',
                        'btnType' => ZButtonWidget::btnType['button'],
                    ]
                ],
            ],
            'event' => [
                'ajaxSuccess' => <<<JS
        function(data) {
        
            data = JSON.parse(data)
             console.log(data.error) 
            if (data.error)
                alert(data.error)
              
            if (data.path) {
                window.open(data.path, '_blank');
                location.reload()
            }
            
        }
JS,
            ]
        ]);

        $shipment = ZGetChecksWidget::widget([
            'model' => $model,
            'config' => [
                'url' => ZUrl::to([
                    '/api/shop/cart/actOb',
                    'type' => 'multiRouteList',
                    'attribute' => 'status_logistics',
                    'modelClassName' => $model->className,
                    'requiredClassName' => 'ShopOrder',
                    'value' => 'shipment_ready',
                ]),
                'noConfirm' => true,
                'btnOptions' => [
                    'config' => [
                        'btn' => false,
                        'text' => Az::l('Маршрутный лист'),
                        'btnStyle' => 'btn btn-micro fp-14 text-nowrap text-muted pt-2',
                        'attribute' => 'status',
                        'btnRounded' => true,
                        'class' => 'simple-ShopOrder text-nowrap',

                        'btnType' => ZButtonWidget::btnType['button'],
                    ]
                ],
            ],
            'event' => [
                'ajaxSuccess' => <<<JS
        function(data) {
            if (data.error)
                alert(data.error)
            if (data.path) {
                window.open(data.path, '_blank');
                location.reload()
            }
        }
JS,
            ]
        ]);

        /** @var ZView $this */

        $model->columns();

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
            'leftBtn' => [
                'update' => [
                    'content' => $akt . $shipment,
                    'options' => [
                        'class' => 'btn-group p-1 {btnSize} {iconSize}'
                    ]
                ],
            ],
            'config' => [
                'pjax' => false,
                'updateUrl' => '{fullUrl}/process.aspx?shop_shipment_id={id}',
                'spaArray' => [
                    'create' => true,
                    'update' => false,
                ],
                'spaHeight' => [
                    'create' => '700px',
                    'view' => '750px'
                ],
                'actionButtons' => [
                    'update',
                    'delete',
                    'clone',
                    'view',
                ],
                'columnAfter' => false,
                'columnBefore' => [
                    'serial',
                    'checkbox',
                    'action',
                ],
            ]
        ]);

        $this->pjaxEnd();
        ?>

    </div>
  </div>


</div>


