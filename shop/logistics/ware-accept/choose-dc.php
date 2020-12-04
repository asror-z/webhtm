<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\shop\ShopOrder;
use zetsoft\models\ware\WareAccept;
use zetsoft\models\ware\WareReturn;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\helpers\ZVarDumper;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZCheckButtonWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\menus\ZMmenuWidgetSh;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\place\PlaceCountry;


/** @var ZView $this */


/**
 *
 * Action Params
 * @author MurodovMirbosit
 */

$action = new WebItem();

$action->title = Azl . 'Заказы';
$action->icon = 'fal fa-line-chart';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = false;



$this->paramSet(paramAction, $action);


$checkKeys = $this->httpPost('checkKeys');
$ware_accept_id = $this->httpGet('ware_accept_id');

$ware_accept = WareAccept::findOne($ware_accept_id);

$dc_group = [];
if (!empty($ware_accept->dc_returns_group))
    $dc_group = $ware_accept->dc_returns_group;

$dc_group = ZArrayHelper::merge($dc_group, $checkKeys);

foreach ($checkKeys as $checkKey) {
    $ware_return = WareReturn::findOne($checkKey);
    $ware_return->status = WareReturn::status['delivered'];
    $ware_return->save();
    //Az::$app->market->wares->enterShopOrderItems($checkKey);
}

$ware_accept->dc_returns_group = $dc_group;
$ware_accept->save();

