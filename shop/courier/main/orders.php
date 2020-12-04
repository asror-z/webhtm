<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\shop\ShopOrder;
use zetsoft\models\shop\ShopOrderItem;
use zetsoft\models\shop\ShopShipment;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZCheckSelectWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\inputes\ZSelect2Widget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;


/** @var ZView $this */


/**
 *
 * Action Params
 * @author MurodovMirbosit
 */

$action = new WebItem();

$action->title = Azl . 'Редактирование'; /*Поступление товаров в склад*/


$action->icon = 'fal fa-film';
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
<style>
    .iframe-orders {
        border: none;
        min-height: 600px;
    }
</style>

<div id="page">
    <nav id="menu"></nav>

    <?

    echo ZSessionGrowlWidget::widget();?>

    <div id="content" class="content-footer p-3">


        <div class="row">
            <div class="col-md-12">

                <?

               $shop_shipment_id = $this->httpGet('shop_shipment_id');
               $user = new \zetsoft\models\user\User();
               $model = new ShopOrder();
               $model->configs->query = ShopOrder::find()
               ->where([
                     'shop_shipment_id' => $shop_shipment_id,
                     /*'place_region_id' => $user->place_region_id,*/
               ]);

               $model->configs->nameOn = [
                   'name',
                   'status_accept',
                   'code',
                   'date',
                   'responsible',
                   'user_id',
                   'contact_name',
                   'contact_phone',
                   'add_contact_phone',
                   'comment_user',
                   'place_adress_id',
                   'distance',
                   'user_company_ids',
                   'date_deliver',
                   'delayed_deliver_date',
                   'price',
                   'prepayment',
                   'deliver_price',
                   'total_price',
                   'payment_type',
                   'additional_payment_type',
                   'additional_deliver',
                   'additional_received_money',

               ];
               
                $model->configs->readonlyOff = [
                 'status_accept'
                ];
                $model->columns();


                /** @var ZView $this */
                echo ZDynaWidget::widget([

                    'model' => $model,
                    'rightBtn' => [
                        'add-tabular-clone-delete' => [
                            'content' => '{add}',
                            'options' => ['class' => 'btn-group p-1 mr-2 {btnSize} {iconSize}']
                        ],
                        'update' => [
                            'content' => '{update}',
                            'options' => ['class' => 'd-none']
                        ],
                    ],

                    'config' => [
                        'hasToolbar' => false,
                        'isCard' => false,
                        'spaHeight' => [
                            'create' => '800px'
                        ],
                        'spa' => true,
                        'columnBefore' => [
                            'serial',
                            'id',
                            'checkbox',
                        ],
                        'columnAfter' => false,
                        'actionButtons' => [
                        ],
                    ]

                ]);

                ?>

            </div>
        </div>
    </div>
</div>

<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>


