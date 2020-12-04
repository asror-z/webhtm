<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\data\TabItem;
use zetsoft\models\shop\ShopOrder;
use zetsoft\models\shop\ShopShipment;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZCheckSelectWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\inputes\ZHInputWidget;
use zetsoft\widgets\inputes\ZSelect2Widget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\navigat\ZSmartTabWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\ware\WareAccept;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Приёмка от курьера';
$action->icon = 'fal fa-cube';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;



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
echo ZMmenuWidget::widget([
    //'data' => $this->cores->menus->create('mmenu'),
    'config' => [
        'theme' => 'white',
        'content.img.width' => 230,
        'iconbar.top' => [
            "<a href='#/'><i class='fa fa-home'></i>cc</a>",
            "<a href='#/'><i class='fa fa-home'></i>cc</a>",
        ],
        'iconbar.bottom' => [
            "<a href='#/'><i class='fa fa-home'></i>aa</a>",
            "<a href='#/'><i class='fa fa-home'></i>cc</a>",
        ],
        'all.border' => ZMMenuWidget::border['border-full'],
        'menu-effect-slide' => true,
    ],
]);
?>
<style>
    .iframe-return {
        border: none;
        height: 100vh;
    }
</style>
<div id="content" class="content-footer p-3">
    <div class="row">
        <div class="col-md-12 col-12">

            <?
            require Root . '/webhtm/block/header/main.php';
            require Root . '/webhtm/block/navbar/admin.php';

            echo ZSessionGrowlWidget::widget();
            $ware_return_id = $this->httpGet('ware_return_id');
            $shop_shipment_id = $this->httpGet('shop_shipment_id');

            $tabData = [];

            $returnSrc = ZUrl::to([
                'return',
                'ware_return_id' => $ware_return_id,
            ]);

            $shipmentSrc = ZUrl::to([
                'shipment',
                'shop_shipment_id' => $shop_shipment_id,
            ]);

            $tab = new TabItem();
            $tab->title = Az::l('Возвраты');
            $tab->content = "<iframe id='shop_return' class='iframe-return' width='100%' height='auto' src='$returnSrc'></iframe>";

            $tabData[] = $tab;

            $tab = new TabItem();
            $tab->title = Az::l('Заказы');
            $tab->content = "<iframe id='shop_order_items' class='iframe-return' width='100%' height='auto' src='$shipmentSrc'></iframe>";
           
            $tabData[] = $tab;

            echo ZSmartTabWidget::widget([
                'data' => $tabData,
            ]);
            ?>
        </div>
    </div>

</div>
<?
require Root . '\webhtm\block\footer\footerAdmin.php' ?>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>

