<?php

use PhpOffice\PhpSpreadsheet\Shared\OLE\PPS\Root;
use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\data\TabItem;
use zetsoft\models\shop\ShopOrder;
use zetsoft\models\ware\WareAccept;
use zetsoft\models\ware\WareEnterItem;
use zetsoft\models\ware\WareExit;
use zetsoft\models\ware\WareExitItem;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\inputes\ZHHiddenInputWidget;
use zetsoft\widgets\navigat\ZSmartTabWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\models\ware\WareEnter;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Редактирование Поступление товаров в склад';


$action->icon = 'fal fa-film';
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

?>

<style>
    .iframe-orders {
        border:none;
        min-height: 600px;
    }
</style>

<div id="page">

    <?

    require Root . '/webhtm/block/navbar/main.php';

    echo ZSessionGrowlWidget::widget();?>

    <div id="content" class="content-footer p-3">


        <div class="row">
            <div class="col-md-12 col-12">

                <?
                $id = $this->httpGet('id');
                $wareAccept = WareAccept::findOne($id);

                if ($this->modelSave($wareAccept))
                    $this->urlRedirect(['index', true]);

                $wareAccept->configs->nameOn = [
                    'id',
                    'name',
                    'date',
                    'status',
                    'shop_courier_id',
                    'shop_shipment_id',
                ];


                ZCardWidget::begin([
                    'config' => [
                        'title' => Az::$app->view->title,
                        'type' => ZCardWidget::type['dynCard'],
                    ]
                ]);

                $form = $this->activeBegin();

                $wareAccept->configs->options = [
                    'shop_shipment_id' => [
                        'config' => [
                            'method' => 'getShipmentByCourierId',
                            'depend' => 'shop_courier_id',
                        ],
                        'event' => [
                            'change' => <<<JS
        function() {
           
$('#shop_orders').attr('src', '/shop/admin/ware-accept/orders.aspx?shop_shipment_id=' + $(this).val())
$('#shop_order_items').attr('src', '/shop/admin/ware-accept/orderItems.aspx?shop_shipment_id=' + $(this).val())
           
        }
JS
                        ],

                    ]
                ];

                $wareAccept->columns();
                echo ZFormWidget::widget([
                    'model' => $wareAccept,
                    'form' => $form,
                ]);

                $this->activeEnd();

                ZCardWidget::end();


                $tabData = [];

                $orderSrc = ZUrl::to([
                    '/shop/admin/ware-accept/orders',
                    'shop_shipment_id' => $wareAccept->shop_shipment_id
                ]);
                $orderItemsSrc = ZUrl::to([
                    '/shop/admin/ware-accept/orderItems',
                    'shop_shipment_id' => $wareAccept->shop_shipment_id
                ]);

                $tab = new TabItem();
                $tab->title = 'Заказы';
                $tab->content = "<iframe id='shop_orders' class='iframe-orders' width='100%' height='auto' src='$orderSrc'></iframe>";

                $tabData[] = $tab;

                $tab = new TabItem();
                $tab->title = 'Товары';
                $tab->content = "<iframe id='shop_order_items' class='iframe-orders' width='100%' height='auto' src='$orderItemsSrc'></iframe>";

                $tabData[] = $tab;

                echo ZSmartTabWidget::widget([
                    'data' => $tabData
                ])


                ?>

            </div>
        </div>


    </div>

</div>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
