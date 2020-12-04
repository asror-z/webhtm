<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\shop\ShopCourier;
use zetsoft\models\shop\ShopOrder;
use zetsoft\models\shop\ShopOrderItem;
use zetsoft\models\shop\ShopShipment;
use zetsoft\service\forms\Active;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\models\ware\WareAccept;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Создание Поступление товаров в склад';
$action->icon = 'fal fa-cube';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = false;



$this->paramSet(paramAction, $action);

$accept_id = $this->httpGet('id');
$form = $this->httpPost();


$shipment_id = $this->sessionGet('shop_shipment_id');
$shopShipment = ShopShipment::findOne($shipment_id);
$shopOrders = collect(ShopOrder::findAll(['shop_shipment_id' => $shopShipment->id]));
$shop_order_ids = ZArrayHelper::getColumn($shopOrders, 'id');
$shopOrderItem = ShopOrderItem::findAll(['shop_order_id' => $shop_order_ids]);

$wareAccept = WareAccept::findOne($accept_id);
//Result
$wareAccept->total = count($shopOrders);               //Всего
$wareAccept->completed = $shopOrders->where('status_accept', ShopOrder::status_accept['completed'])->count();  //Выполнен
$wareAccept->exchange = $shopOrders->where('status_accept', ShopOrder::status_accept['exchange'])->count();   //Обмен
$wareAccept->date_transfer = $shopOrders->where('status_accept', ShopOrder::status_accept['delivery_transfer'])->count(); //Перенос даты

$wareAccept->refusal = $shopOrders->where('status_accept', ShopOrder::status_accept['delivery_failure'])->count();  //Отказ
$wareAccept->cancel = $shopOrders->where('status_accept', ShopOrder::status_accept['cancel'])->count();   //Отменено

$courier = ShopCourier::findOne($shopShipment->shop_courier_id);
//Total sums
$total_price = $shopOrders->sum('total_price');
$total_deliver_price = $shopOrders->sum('deliver_price');
$wareAccept->sales_amount = (double)$total_deliver_price + (double)$total_price;  //Сумма реализации
$wareAccept->courier_reward = $wareAccept->completed * $courier->award_order;       //Вознаграждение курьеру

$wareAccept->exchange_reward = $wareAccept->exchange * $courier->award_exchange;  //Вознаграждение обмен
$wareAccept->refund_reward = $wareAccept->exchange * $courier->award_return;    //Вознаграждение за ВДС
$wareAccept->salary_courier = $wareAccept->courier_reward + $wareAccept->exchange_reward + $wareAccept->refund_reward + ($wareAccept->bonus ? 30000 : 0);  //ЗП курьеру

$wareAccept->terminal = $shopOrders->whereIn('additional_payment_type', [ShopOrder::additional_payment_type['uzcard'], ShopOrder::additional_payment_type['humo']])->sum('additional_received_money');   //Терминал

$wareAccept->add_delivery = $shopOrders->where('additional_payment_type', ShopOrder::additional_payment_type['add_deliver'])->sum('additional_received_money');  //Допольнительные доставки

//ВДС - dc_returns_group
if (!$this->emptyVar($wareAccept->dc_returns_group) && $wareAccept->dc_returns_group != null) {
    $tempOrders = collect(ShopOrder::findAll($wareAccept->dc_returns_group));
   
    $wareAccept->refund = $tempOrders->sum('additional_received_money'); //Возврат денежных средств
} else {
    $wareAccept->refund = 0;   //Возврат денежных средств
}
$wareAccept->cashless = $shopOrders->where('additional_payment_type', ShopOrder::additional_payment_type['transfer'])->sum('additional_received_money');     //Безналичные

$wareAccept->remain = $wareAccept->sales_amount - ($wareAccept->salary_courier + $wareAccept->add_delivery + $wareAccept->terminal + $wareAccept->cashless);

$wareAccept->save();

echo true;

