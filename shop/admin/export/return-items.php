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

        <?

        echo ZSessionGrowlWidget::widget();$ware_accept_id = $this->httpGet('ware_accept_id');

        $ware_accept = WareAccept::findOne($ware_accept_id);

        $order_item = new ShopOrderItem();

        $order_item->configs->nameOn = [
            'shop_order_id',
            'shop_catalog_id',
            'ware_return_id',
            'amount_partial',
            'amount_return',
            'price_all',
            'price_all_return',
        ];

        $order_item->configs->width = [
            'shop_order_id' => '150px',
            'amount_partial' => '50px',
            'amount_return' => '50px',
            'price_all' => '130px',
        ];

        $feruzas = [];

        if (!empty($ware_accept->dc_returns_group)) {
            $feruzas = $ware_accept->dc_returns_group;
        }

        $order_item->query = ShopOrderItem::find()
            ->orderBy([
                'created_at' => SORT_DESC
            ])
            ->where([
                'ware_return_id' => $feruzas
            ]);

        $ware_accept_id = $this->httpGet('ware_accept_id');
        $wareAccept = WareAccept::findOne($ware_accept_id);

        $btns = [
            'update' => [
                'content' => '{update}',
                'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
            ],
        ];

        if ($wareAccept->status === WareAccept::status['accept']) {
            $btns = [];
        }

        $order_item->columns();

        echo ZDynaWidget::widget([
            'model' => $order_item,
            'rightBtn' => $btns,
            'rightName' => [
                'add-tabular-clone-delete',
                'update',
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
                'chooseUrl' => '{fullUrl}/choose-orders.aspx?ware_accept_id=' . $ware_accept_id,
                'theme' => ZDynaWidget::theme['panel-success'],
                'deleteAllUrl' => '/shop/admin/ware-accept/delete-orders.aspx?ware_accept_id=' . $ware_accept_id,
                'columnBefore' => [
                    'serial',
                    'id',
                    'checkbox',
                ],
                'columnAfter' => false
            ]
        ])


        ?>
    </div>

    <?php $this->endBody() ?>

    </body>
    </html>

<?php $this->endPage() ?>


<?php

