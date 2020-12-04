<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\place\PlaceAdress;
use zetsoft\models\shop\ShopCourier;
use zetsoft\models\shop\ShopShipment;
use zetsoft\models\shop\ShopOrder;
use zetsoft\service\forms\Active;
use zetsoft\system\Az;
use zetsoft\system\column\ZKDataColumn;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZCheckButtonWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\inputes\ZInputWidget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\notifier\ZSweetAlert2Widget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\models\ware\WareEnter;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Назначение заказов курьеру';


$action->icon = 'fal fa-film';
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

    <div class="col-md-12 mx-auto">

        <?php

        $shop_shipment_id = $this->httpGet('shop_shipment_id');

        $shipment = ShopShipment::findOne($shop_shipment_id);

        $shipment->configs->readonlyWidgetOff = [
            'shop_courier_id',
            'comment'
        ];
        $shipment->date = Az::$app->cores->date->fbDateTime();
        $shop_courier = ShopCourier::findOne($shipment->shop_courier_id);
        ZSweetAlert2Widget::begin([
            
            'config' => [
                'title' => $shop_courier? Az::l((string)$shop_courier->name): '',
                'funcName' => 'changeRegionSweet',
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

        <iframe id="shopshipment-iframe_courier" width="900px" height="700px"></iframe>

        <?php

        ZSweetAlert2Widget::end();

        $button = ZButtonWidget::widget([
            'config' => [
                'btn' => false,
                'icon' => 'fas fa-link',
                'btnType' => ZButtonWidget::btnType['link'],
            ],
            'event' => [
                'click' => <<<JS
               function() {
               
                   window.changeRegionSweet()
                   
                   $('#swal2-title').hide()
                   
                   var url = 'update-region.aspx?id=' + $('#shopshipment-shop_courier_id').val() + '&shop_shipment_id={$shop_shipment_id}';
                   
                   $('#shopshipment-iframe_courier').attr('src', url)
                   
               }
JS,
            ]
        ]);

        $shipment->configs->options = [
            'shop_courier_id' => [
                'config' => [
                    'addonAppendContent' => $button,
                ],
            ]
        ];

        $shipment->cards = [
            [
                'title' => Az::l('Первый этап'),
                'items' => [
                    [
                        'title' => Az::l('Форма'),
                        'items' => [
                            [
                                'date',
                                'date_deliver',
                            ],
                            [
                                'shipment_type',
                                'responsible',
                            ],
                            [
                                'shop_courier_id',
                                'comment',
                            ],
                        ],
                    ],
                ],
            ]
        ];

        $shipment->configs->changeSave = true;
        
        $shipment->responsible = $this->userIdentity()->id;

        $shipment->columns();

        if ($this->modelSave($shipment)) {
            $this->urlRedirect(['index', true]);
        }

        $active = new Active();
        $active->type = Active::type['vertical'];
        $active->childClass = 'my-3';

        $form = $this->activeBegin($active);

        echo ZFormBuildWidget::widget([
            'model' => $shipment,
            'form' => $form,
            'config' => [
                'btnTitle' => Az::l('Провести и закрыть'),
                'stepType' => ZFormBuildWidget::stepType['none'],
                'blockType' => ZFormBuildWidget::blockType['naked'],
                'botBtn' => false,
            ]
        ]);

        $this->activeEnd();
        ?>

    </div>


    <div class="mt-5 mx-auto col-md-12">

        <?
        
        $this->pjaxBegin();
        $model = new ShopOrder();

        $shop_courier = ShopCourier::findOne($shipment->shop_courier_id);

        //start|NurbekMakhmudov|2020-10-24
        if ($shop_courier === null) return null;
        //end|NurbekMakhmudov|2020-10-24


        $place_region_ids = $shop_courier->place_region_ids;

        $model->configs->query = ShopOrder::find()
            ->where([
                'shop_shipment_id' => $shipment->id,

                /* 'status_logistics' =>
                    [
                     ShopOrder::status_logistics['courier_appointment'],
                     ShopOrder::status_logistics['reported'],
                    ]
                */
                 
            ]);

        $model->configs->nameOn = [
            'number',
            'name',
            'user_id',
            'date_deliver',
            'place_adress_id',
            'user_company_ids',
            'place_adress_id',
            'payment_type',
            'status_logistics',
            'total_price',
        ];

        $model->configs->dynaButtons = [
            'add-tabular-clone-delete' => [
                'content' => '{choose}{delete}',
                'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
            ],
        ];
        $model->configs->changeSave = true;
        $model->columns();

        echo ZDynaWidget::widget([
            'model' => $model,
            'config' => [
                'pjax' => false,
                'deleteAllUrl' => '/api/shop/orders/deleteShipment.aspx',
                'spaHeight' => [
                    'create' => '700px',
                    'choose' => '800px'
                ],
                'spaWidth' => [
                    'create' => '700px',
                    'choose' => '900px'
                ],
                'chooseUrl' => '{fullUrl}/choose.aspx?date_deliver=' . $shipment->date_deliver . '&shop_shipment_id=' . $shop_shipment_id . '&all=1',
                'hasToolbar' => true,
                'spa' => true,
                'title' => Az::l('Подобранные заказы'),
                'search' => false,
                'headerIcon' => '',
                'bordered' => false,
                'columnBefore' => [
                    'serial',
                    'checkbox',
                    'id'
                ],
                'columnAfter' => false,
            ]

        ]);
        $this->pjaxEnd();
        ?>

    </div>

</div>

