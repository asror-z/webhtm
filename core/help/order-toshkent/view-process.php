<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\shop\ShopOrderItem;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZViewWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\shop\ShopOrder;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Просмотр Заказы';
$action->icon = 'fal fa-power-off';
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
    echo ZSessionGrowlWidget::widget();?>

    <div id="content" class="content-footer p-3">


        <div class="row">
            <div class="col-md-12 col-12">

                <?


                $shop_order_id = $this->httpGet('shop_order_id');
                $model = new ShopOrder();
                $model->configs->query = ShopOrder::findOne($shop_order_id);

                $model->cards = [
                    [
                        'title' => Az::l('Первый этап'),
                        'shows' => true,
                        'items' => [
                            [
                                'title' => Az::l('Форма'),
                                'shows' => true,
                                'items' => [
                                    [
                                        'name',
                                        'code',
                                    ],
                                    [
                                        'date',
                                        'responsible',
                                    ],
                                    [
                                        'user_id',
                                        'contact_name',
                                    ],
                                    [
                                        'contact_phone',
                                        'add_contact_phone',
                                        'called_time',
                                    ],
                                    [
                                        'comment_user',
                                        'place_adress_id',
                                    ],
                                    [
                                        'distance',
                                        'user_company_ids',
                                    ],
                                    [
                                        'ware_ids',
                                        'operator',
                                    ],
                                    [
                                        'comment_agent',
                                        'tasks',
                                    ],
                                    [
                                        'source',
                                        'shop_reject_cause_id',
                                    ],
                                    [
                                        'status_client',
                                        'status_callcenter',
                                    ],
                                    [
                                        'status_accept',
                                        'date_deliver',
                                    ],
                                    [
                                        'date_approve',
                                        'date_return',
                                    ],
                                    [
                                        'delayed_deliver_date',
                                        'weight_plan',
                                    ],
                                    [
                                        'shop_delay_id',
                                        'shop_delay_cause_id',
                                    ],
                                    [
                                        'packaging',
                                        'labelled',
                                    ],
                                    [
                                        'fragile',
                                        'weight',
                                    ],
                                    [
                                        'volume',
                                        'shop_shipment_id',
                                    ],
                                    [
                                        'price',
                                        'deliver_price',
                                    ],
                                    [
                                        'total_price',
                                        'shop_coupon_id',
                                    ],
                                    [
                                        'shop_channel_id',
                                        'payment_type',
                                    ],
                                    [
                                        'additional_payment_type',
                                        'additional_received_money',
                                    ],
                                    [
                                        'additional_deliver',
                                        'prepayment',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ];

                $model->columns();
                
                echo ZViewWidget::widget([
                    'model' => $model,
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
