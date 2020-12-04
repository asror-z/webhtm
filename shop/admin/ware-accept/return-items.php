<?php

use zetsoft\dbitem\core\WebItem;
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

            if (!empty($ware_accept->dc_returns_group)) {
                $dc_returns_group = $ware_accept->dc_returns_group;
            }

            $order_item = new ShopOrderItem();

            $order_item->query = ShopOrderItem::find()
                ->orderBy([
                    'created_at' => SORT_DESC
                ])
                ->where([
                    'ware_return_id' => $dc_returns_group
                ]);

            $order_item->configs->nameOn = [
                'shop_order_id',
                'shop_catalog_id',
                'ware_retun_id',
                'ware_return_id',
                'amount_partial',
                'amount_return',
                'price_all',
                'price_all_return',
            ];

            $order_item->configs->width = [
                'shop_order_id' => '250px',
                'shop_catalog_id' => '250px',
                'amount_partial' => '50px',
                'amount_return' => '50px',
                'price_all' => '130px',
            ];

            $order_item->columns();

            echo ZDynaWidget::widget([
                'model' => $order_item,
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
                    'spaWidth' => [
                        'choose' => '1000px'
                    ],
                    'spaHeight' => [
                        'choose' => '750px'
                    ],
                    'theme' => ZDynaWidget::theme['panel-success'],
                    'chooseUrl' => '{fullUrl}/choose-orders.aspx?ware_accept_id=' . $ware_accept_id,
                    'deleteAllUrl' => '/shop/admin/ware-accept/delete-orders.aspx?ware_accept_id=' . $ware_accept_id,
                    'columnBefore' => [
                        'checkbox',
                        'serial',
                        'id',
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
