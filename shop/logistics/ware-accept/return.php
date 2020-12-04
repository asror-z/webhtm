<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\ware\WareReturn;
use zetsoft\models\shop\ShopOrder;
use zetsoft\system\Az;
use zetsoft\system\column\ZKDataColumn;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\inputes\ZKSelect2Widget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\menus\ZMmenuWidgetSh;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\ware\WareAccept;
use zetsoft\models\shop\ShopOrderItem;
use zetsoft\widgets\notifier\ZSweetAlert2Widget;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Поступление товаров в склад';
$action->icon = 'fal fa-cube';
$action->type = WebItem::type['html'];
$action->debug = false;
$action->loader = false;

$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();


/**
 *
 * Start Page
 */

$this->beginPage();
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>

    <?php

    require Root . '/webhtm/block/metas/main.php';
    require Root . '/webhtm/block/assets/main.php';

    $this->head();

    ?>

</head>


<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php

$this->beginBody();

echo ZNProgressWidget::widget([]);
?>

<div id="page">
    <div class="col-md-12 pt-4">
        <?php
        $ware_accept_id = $this->httpGet('ware_accept_id');

        $ware_accept = WareAccept::findOne($ware_accept_id);

        $dc = $ware_accept->dc_returns_group;
        if (empty($dc)) {
            $dc = null;
        }
        $ware_returns = new WareReturn();
        $ware_returns->query = WareReturn::find()
            ->orderBy([
                'created_at' => SORT_DESC
            ])
            ->where([
                'id' => $dc
            ]);

        //start|MurodovMirbosit|21.10.2020
        /*$return_id = null;

        if (!empty($ware_returns->shop_order_ids)) {
            foreach ($ware_returns as $ware_return) {
                $return_id = $ware_return->shop_order_ids;
            }
        }
        $shop_order = new ShopOrderItem();
        $shop_order->query = ShopOrderItem::find()->where(['shop_order_id' => $return_id]);
        //2version

        foreach ($ware_returns as $ware_return) {

            if (!empty($ware_return->shop_order_ids)) {
                $shop_orders = ShopOrder::find()
                    ->where([
                        'id' => $ware_return->shop_order_ids
                    ])->all();
              

                $shop_order_item = new ShopOrderItem();
                foreach ($shop_orders as $shop_order) {
                    if (!empty($shop_order->id)) {
                        $shop_order_item->query = ShopOrderItem::find()->where(['shop_order_id' => $shop_order->id]);
                    }
                }
            }
        $shop_order->configs->nameOn = [
            'number',
            'name',
            'code',
            'contact_name',
            'contact_phone',
            'children',
            'parent',
            'status_logistics',
            'status_callcenter',
            'status_universal',
            'status_accept',
            'shop_shipment_id',
            'date_deliver',
            'date_approve',
            'place_adress_id',
            'user_company_ids',
            'ware_ids',
            'payment_type',
            'price',
            'deliver_price',
            'total_price',
            'date',
            'responsible',
            'user_id',
            'operator',
            'comment_agent',
            'tasks',
            'source',
            'shop_reject_cause_id',
            'status_client',
            'date_return',
            'delayed_deliver_date',
            'weight_plan',
            'shop_delay_id',
            'shop_delay_cause_id',
            'shop_coupon_id',
            'shop_channel_id',
            'additional_payment_type',
            'additional_received_money',
            'additional_deliver',
            'prepayment',
        ];
        }*/
        //end|MurodovMirbosit|21.10.2020

        $ware_accept_id = $this->httpGet('ware_accept_id');

        $isReadonly = false;
        if ($ware_accept->closed) {
            $isReadonly = true;
        }

        $readonly = false;

        if ($ware_accept->status === WareAccept::status['accept'] || $isReadonly || $ware_accept->status === WareAccept::status['generate_doc']) {
            $readonly = true;
        }

        $ware_returns->configs->readonly = $readonly;
        $ware_returns->configs->nameOn = [
            'name',
            'shop_order_ids',
            'ware_id',
            'total_price',
            'comment'
        ];
        $ware_returns->columns();

        echo ZDynaWidget::widget([
            'model' => $ware_returns,
            'rightBtn' => [
                [
                    'content' => '',
                    'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                ],
                'clear_update' => [
                    'content' => '{clear_update}',
                    'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                ],
                'filterPjax' => [
                    'content' => '',
                    'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
                ],
                'system' => [
                    'content' => '',
                    'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                ],

                'add-clone-delete' => [
                    'content' => '{choose}{delete}',
                    'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                ],

                'filter-sort-id' => [
                    'content' => '',
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
                    'content' => '',
                    'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
                ],
            ],
            'leftNameEx' => [
                'barcode'
            ],
            'config' => [
                'spaWidth' => [
                    'choose' => '1000px'
                ],
                'chooseUrl' => '{fullUrl}/choose-orders.aspx?ware_accept_id=' . $ware_accept_id,
                'title' => Az::l('Возвраты ДС'),
                'deleteAllUrl' => '/shop/logistics/ware-accept/delete-orders.aspx?ware_accept_id=' . $ware_accept_id,
                'columnBefore' => [
                    'checkbox',
                ],
                'spaArray' => [
                    'update' => false,
                    'create' => true,
                ],
                'spaHeight' => [
                    'create' => '750px',
                    'view' => '618px',
                ],
                'columnAfter' => false,
            ]
        ])

        ?>
    </div>
</div>

<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
