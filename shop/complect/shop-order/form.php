<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\place\PlaceAdress;
use zetsoft\models\shop\ShopOrder;
use zetsoft\models\shop\ShopOrderItem;
use zetsoft\service\cores\Date;
use zetsoft\system\except\ZException;
use zetsoft\service\forms\Active;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZBanderolWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZExportBtnWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\former\ZGetChecksWidget;
use zetsoft\widgets\former\ZPdfWidget;
use zetsoft\widgets\inputes\ZHInputWidget;
use zetsoft\widgets\inputes\ZInputBtnWidget;
use zetsoft\widgets\inputes\ZInputWidget;
use zetsoft\widgets\inputes\ZKDateTimePickerWidget;
use zetsoft\widgets\inputes\ZLibraInputWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\dbitem\data\TabItem;
use zetsoft\widgets\navigat\ZSmartTabWidget;


/** @var ZView $this */


/**
 *
 * Action Params
 * @author MurodovMirbosit
 */


$shop_order_id = $this->httpGet('shop_order_id');
$fullWebId = $this->httpGet('fullWebId');

$order = ShopOrder::findOne($shop_order_id);

//start|DavlatovRavshan|2020.10.10
$place = PlaceAdress::findOne($order->place_adress_id);
if (!$place) {

    $place = new PlaceAdress();
    $place->configs->rules = validatorSafe;

    if ($place->save()) {
        $order->place_adress_id = $place->id;
        $order->save();
        $this->urlRedirect([
            $this->urlArrayStr,
            'shop_order_id' => $order->id
        ]);
    }

}
//end | DavlatovRavshan | 10.10.2020

$place->configs->changeSave = true;

$place->cards = [
    [
        'title' => Az::l('Первый этап'),
        'shows' => true,
        'items' => [
            [
                'title' => Az::l('Форма'),
                'shows' => true,
                'items' => [
                    [
                        'place_country_id',
                        'place_region_id',
                        'street',
                    ],
                    [
                        'home',
                        'orientation',
                        'place',
                        'postal_code',
                    ]
                ],
            ],
        ],
    ],
];
$place->columns();

echo ZFormBuildWidget::widget([
    'model' => $place,
    //'form' => $form,
    'config' => [
        'stepOptions' => [
            'config' => [
                'mcontent' => 'p-3',
            ],
        ],
        'botBtn' => false,
        'topBtn' => false,
        //'cols' => 12,
    ],
]);
