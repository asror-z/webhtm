<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\shop\ShopOrder;
use zetsoft\models\ware\WareReturn;
use zetsoft\system\Az;
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

        $dc_returns_group = [];

        $dc = $ware_accept->dc_returns_group;
        if (empty($dc)) {
            $dc = null;
        }

        $ware_returns = WareReturn::find()
            ->orderBy([
                'created_at' => SORT_DESC
            ])
            ->where([
                'id' => $dc
            ])->all();

        $isReadonly = false;
        if ($ware_accept->closed) {
            $isReadonly = true;
        }

        $readonly = false;
        if ($ware_accept->status === WareAccept::status['accept'] || $isReadonly || $ware_accept->status === WareAccept::status['generate_doc']) {
            $readonly = true;
        }
        //start|MurodovMirbosit|21.10.2020
        $shop_order_ids = null;
        foreach ($ware_returns as $ware_return) {
            $shop_order_ids = $ware_return->shop_order_ids;
        }

        $shop_order = new ShopOrder();
        $shop_order->query = ShopOrder::find()->where(['id' => $shop_order_ids]);
        $shop_order->configs->readonly = $readonly;
        $shop_order->columns();

        /*$shop_order = new ShopOrderItem();

        $shop_order->query = ShopOrderItem::find()
            ->orderBy([
                'created_at' => SORT_DESC
            ])
            ->where([
                'ware_return_id' => $dc_returns_group
            ]);*/

        /*    $shop_order->configs->nameOn = [
                'shop_order_id',
                'shop_catalog_id',
                'ware_retun_id',
                'ware_return_id',
                'amount_partial',
                'amount_return',
                'price_all',
                'price_all_return',
            ];

            $shop_order->configs->width = [
                'shop_order_id' => '250px',
                'shop_catalog_id' => '250px',
                'amount_partial' => '50px',
                'amount_return' => '50px',
                'price_all' => '130px',
            ];*/
        //end|MurodovMirbosit|21.10.2020
        echo ZDynaWidget::widget([
            'model' => $shop_order,
            'rightBtn' => [
                [
                    'content' => '{update}',
                    'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
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
                'theme' => ZDynaWidget::theme['panel-success'],
                'columnBefore' => [
                    'checkbox',
                    'serial',
                    'id',
                ],
                'chooseUrl' => '{fullUrl}/choose-orders.aspx?ware_accept_id=' . $ware_accept_id,
                'deleteAllUrl' => '/shop/logistics/ware-accept/delete-orders.aspx?ware_accept_id=' . $ware_accept_id,
                'columnAfter' => false,

            ]
        ]);
        ?>

    </div>
</div>

<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
