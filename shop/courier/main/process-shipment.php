<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\data\TabItem;
use zetsoft\models\shop\ShopOrderItem;
use zetsoft\models\shop\ShopOrder;
use zetsoft\models\shop\ShopShipment;
use zetsoft\models\ware\WareReturn;
use zetsoft\service\forms\Active;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZCheckDependWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZExportBtnWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\inputes\ZInputWidget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\navigat\ZSmartTabWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;

/** @var ZView $this */


/**
 *
 * Action Params
 * @author MurodovMirbosit
 */

$action = new WebItem();

$action->title = Azl . 'Заказы';


$action->icon = 'fal fa-film';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = false;



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

    echo ZSessionGrowlWidget::widget();


    ?>
    <style>
        .iframe-return {
            border: none;
            height: 100vh;
        }
    </style>
    <div id="content" class="content-footer p-3">
        <div class="row">
            <div class="col-md-12">

                <?php
                $shop_shipment_id = $this->httpGet('shop_shipment_id');
                $shop_shipment = ShopShipment::findOne($shop_shipment_id);

                $tabData = [];

                $shipmentSrc = ZUrl::to([
                    'orders',
                    'shop_shipment_id' => $shop_shipment_id,
                ]);

                $orderSrc = ZUrl::to([
                    'orderItems',
                    'shop_shipment_id' => $shop_shipment_id,
                ]);

                $tab = new TabItem();
                $tab->title = Az::l('Заказы');
                $tab->content = "<iframe id='shop_order_items' class='iframe-return' width='100%' height='auto' src='$shipmentSrc'></iframe>";

                $tabData[] = $tab;

                $tab = new TabItem();
                $tab->title = Az::l('Товары');
                $tab->content = "<iframe id='shop_return' class='iframe-return' width='100%' height='auto' src='$orderSrc'></iframe>";

                $tabData[] = $tab;

                echo ZSmartTabWidget::widget([
                    'data' => $tabData,
                ]);

                ?>

            </div>


        </div>

    </div>

</div>


<?php
$this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
