<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\place\PlaceAdress;
use zetsoft\models\shop\ShopCourier;
use zetsoft\models\shop\ShopShipment;
use zetsoft\models\shop\ShopOrder;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZCheckButtonWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZFormWidget;
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

$action->title = Azl . 'Редактирование';  /*Поступление товаров в склад*/


$action->icon = 'fal fa-film';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;



$this->paramSet(paramAction, $action);

$model = new ShopOrder();

if (!empty($this->httpPost('courier_id')))
    $courier_id = $this->httpPost('courier_id');

if (!empty($this->httpPost('shipment_id')))
    $shipment_id = $this->httpPost('shipment_id');

$shop_courier = ShopCourier::findOne($courier_id);
$place_region_id = Az::$app->market->courier->placeAdress($shop_courier);

$place_address = PlaceAdress::findOne([
    'place_region_id' => $place_region_id
]);

$model->configs->query = ShopOrder::find()
    ->where([
        'shop_shipment_id' => $shipment_id,
        'place_adress_id' => $place_address->id
    ]);

$model->columns();

echo ZDynaWidget::widget([
    'model' => $model,
    'rightBtn' => [
        'update' => [
            'content' => ZButtonWidget::widget([
                'config' => [
                    'text' => Az::l('Подобрать заказы'),
                ],
                'event' => [
                    'click' => <<<JS
    function() {
         orderSweet()
    }
JS,

                ]
            ]),
            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
        ],

        'add-tabular-clone-delete' => [
            'content' => "",
            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
        ],

        'filter-sort-id' => [
            'content' => '',
            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
        ],

        'export' => [
            'content' => '',
            'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
        ],


        'toggleData' => [
            'content' => '',
            'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
        ],

    ],
    'config' => [
        'hasToolbar' => true,
        'spa' => true,
        'reloadUrl' => ZUrl::to([
            'process',
            'id' => $this->httpGet('id')
        ]),
        'headerIcon' => '',
        'title' => Az::l('Подобранные заказы'),
        'search' => false,
        'width' => 'auto',
        'bordered' => false,
        'columnBefore' => [
            'serial',
            'radio',
            'id'
        ],
    ]

]);


echo ZSweetAlert2Widget::widget([
    'config' => [
        'iframeId' => 'process-order',
        'funcName' => 'orderSweet',
        'url' => ZUrl::to([
            'orders',
            'shop_courier_id' => $courier_id
        ]),
        'height' => '700px',
        'width' => '1000px',

    ]
]);

