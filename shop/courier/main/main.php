<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\data\TabItem;
use zetsoft\models\shop\ShopOrder;
use zetsoft\models\shop\ShopShipment;
use zetsoft\models\ware\WareReturn;
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
 * @author MurodovMirbosit
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
require Root . '/webhtm/block/header/main.php';
require Root . '/webhtm/block/navbar/admin.php';
?>

<div id="content" class="content-footer p-3">


    <div class="row">
        <div class="col-md-12">

            <?
            $model1 = new ShopShipment();
            $model1->shop_courier_id = $this->userIdentity()->id;
            $shipment = ShopShipment::find()->where([
                'shop_courier_id' => $model1->shop_courier_id,
            ]);

            $model1->configs->readonlyWidget = true;
            $model1->columns();


            /** @var ZView $this */
            echo ZDynaWidget::widget([
                'model' => $model1,
                'config' => [
                    'updateUrl' => '{fullUrl}/process-shipment.aspx?shop_shipment_id={id}',
                    'spaHeight' => [
                        'create' => '600px',
                        'view' => '350px',
                    ],

                    'columnBefore' => [
                        'checkbox',
                        'action',
                    ],
                    'actionButtons' => [
                        'update',
                    ],
                    'columnAfter' => false,
                ],
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

                    'export' => [
                        'content' => '',
                        'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
                    ],


                    'toggleData' => [
                        'content' => '',
                        'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
                    ],
                ],

            ]);
            ?>

        </div>
    </div>


</div>


<div id="content" class="content-footer p-3">


    <div class="row">
        <div class="col-md-12">

            <?
            $model = new WareReturn();
            $model->shop_courier_id = $this->userIdentity()->id;
            $shipment = WareReturn::find()->where([
                'shop_courier_id' => $model->shop_courier_id,
            ]);
            $model->configs->readonly = true;
            $model->columns();


            /** @var ZView $this */
            echo ZDynaWidget::widget([
                'model' => $model,
                'config' => [
                    'updateUrl' => '{fullUrl}/process-return.aspx?ware_return_id={id}',
                    'spaArray' => [
                        'update' => true,
                    ],
                    'spaHeight' => [
                        'create' => '600px',
                        'view' => '350px',
                    ],
                    'columnBefore' => [
                        'checkbox',
                        'action',

                    ],
                    'actionButtons' => [
                        'update',
                    ],
                    'columnAfter' => false,
                ],
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

                    'export' => [
                        'content' => '',
                        'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
                    ],


                    'toggleData' => [
                        'content' => '',
                        'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
                    ],
                ]
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

