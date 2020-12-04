<?php


use zetsoft\dbitem\core\WebItem;
use zetsoft\models\shop\ShopOrder;
use zetsoft\models\shop\ShopOrderItem;
use zetsoft\models\shop\ShopShipment;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;

/** @var ZView $this */

$action = new WebItem();
$action->title = Azl . 'Веб-действия';

$action->icon = 'fa fa-bar-chart';
$action->csrf = true;
$action->debug = true;



$this->paramSet(paramAction, $action);

$action->type = WebItem::type['ajax'];



$post = $this->httpPost('radioKeys');

if (!empty($post)) {


    //$shipment_type = $this->httpPost('shipment_type');
    /*$shipment_type = ZArrayHelper::getValue($post, 'shipment_type');
    $address_id = ZArrayHelper::getValue($post, 'address_id');
    $contact_info = ZArrayHelper::getValue($post, 'contact_info');*/
    $address_id = $post[0];

    $product_items = Az::$app->market->product->cartOrders();

    $order_item_ids = [];
    $prices = 0;
    foreach ($product_items as $product_item)
    {
        $order_item = new ShopOrderItem();
        $order_item->shop_catalog_id = $product_item->id;
        $order_item->amount = $product_item->cart_amount;
        $order_item->price = $product_item->price[0];
        if($order_item->save())
        {
            $prices += $order_item->price;
            $order_item_ids[] = $order_item->id;
        }
    }

    $order = new ShopOrder();
    $order->user_id = $this->userIdentity()->id;
    //$order->contact_info =  $contact_info;
    $order->core_adress_id = $address_id;
    $order->core_order_item_ids = $order_item_ids;
    $order->status = ShopOrder::status['new'];
    $order->price = $prices;
    $order->total_price = $prices+10000;
    if($order->save())
    {
        $core_shipment = new ShopShipment();
        //$core_shipment->shipment_type = $shipment_type;
        $core_shipment->order_id = $order->id;
        $core_shipment->payment_type = ShopShipment::payment_type['cash'];
        $core_shipment->status = ShopShipment::status['new'];
        $core_shipment->price = 10000;

        if($core_shipment->save())
        {
            $this->notifySuccess(Az::l('Информация'), Az::l('Ваш заказ успешно сохранен'));
            $this->urlRedirect('/');
        }else{
            vdd("error");
        }

    }

}
