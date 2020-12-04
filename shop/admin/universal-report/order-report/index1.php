<?php

/**
 * @author MurodovMirbosit
 *
 */

use Afosto\Acme\Data\Order;
use zetsoft\dbitem\core\WebItem;
use zetsoft\former\order\OrderForm;
use zetsoft\former\reports\ReportsCourierForm;
use zetsoft\models\shop\ShopOrderItem;
use zetsoft\models\shop\ShopShipment;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\shop\ShopBrand;
use zetsoft\former\order\PayBackCCForm;
use zetsoft\models\shop\ShopOrder;
use zetsoft\system\Az;

/** @var ZView $this */

/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Отчёт по курьерам';
$action->icon = 'fal fa-calendar-times-o';
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


<div id="page">

    <?php
    echo ZSessionGrowlWidget::widget();

    ?>

    <?php

    //    $model = ShopOrder::find()->where(['shop_shipment_id' => ShopShipment::findOne(219)->id])->one();
    //    $model = Az::$app->market->orderNurbek->ordersTransferredToCourier(219);

    $model = new ShopOrder();

    $model->configs->query = ShopOrder::find()
        ->where([
            'status_logistics' => ShopOrder::status_logistics['new'],
            'id' => ShopOrderItem::find()->select(['shop_order_id']),
        ]);


    $model->configs->title = Az::l('Заказы переданные курьеру');
    $model->configs->nameOn = [
        'name',
        'date_deliver',
    ];
    $model->columns();

    /** @var ZView $this */
    echo ZDynaWidget::widget([
        'model' => $model,
        'rightBtn' => [
            'update' => [
                'content' => '',
                'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
            ],

            'system' => [
                'content' => '',
                'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
            ],

            'add-clone-delete' => [
                'content' => '',
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
        'rightName' => [
            'export'
        ],
        'leftNameEx' => [
            'search'
        ],
        'config' => [
            'viewUrl' => '{fullUrl}/view.aspx?shop_order_id={id}',
            'spaHeight' => [
                'view' => '750px',
            ],
            'actionButtons' => [
                'view',
            ],
            'columnBefore' => [
                'serial',
                'action',
            ],
            'columnAfter' => false,
        ],
    ]);

    ?>
</div>

<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
