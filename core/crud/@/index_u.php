<?php


use zetsoft\models\shop\ShopOrderItem;

$order1 = ShopOrderItem::findOne(2124);

echo 'Name:' . $order1->name . ' | ' . 'Shop_order_id:' . $order1->shop_order_id . ' | ' . 'User_company_id:' . $order1->user_company_id;