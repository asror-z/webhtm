<?php

use PhpOffice\PhpSpreadsheet\Shared\OLE\PPS\Root;
use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\data\ConfigDB;
use zetsoft\dbitem\data\TabItem;
use zetsoft\models\ware\WareAccept;
use zetsoft\service\forms\Active;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\inputes\ZInputWidget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\navigat\ZSmartTabWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Приёмка от курьера';


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
echo ZMmenuWidget::widget([

]);
?>

<style>
    .iframe-orders {
        border: none;
        height: 100vh;
    }
</style>

<div id="page">

    <?

    require Root . '/webhtm/block/header/main.php';
    require Root . '/webhtm/block/navbar/admin.php';

    echo ZSessionGrowlWidget::widget();?>

    <div id="content" class="content-footer p-3">


        <div class="row">
            <div class="col-md-12">

                <?

                $ware_accept_id = $this->httpGet('ware_accept_id');

                $wareAccept = WareAccept::findOne($ware_accept_id);

                if ($this->modelSave($wareAccept)) {

                    $this->urlRedirect([
                        'index'
                    ]);

                }

                $wareAccept->configs->hasLabel = true;
                $wareAccept->configs->readonlyWidgets = [
                    'name',
                    'date',
                    /*'shop_courier_id',
                    'shop_shipment_id',*/
                ];
                $wareAccept->cards = [
                    [
                        'title' => Az::l('Первый этап'),
                        'items' => [
                            [
                                'title' => Az::l('Форма'),
                                'items' => [
                                    [
                                        'name',
                                        'date'
                                    ],
                                    [
                                        'shop_courier_id',
                                        'shop_shipment_id'
                                    ],
                                    [
                                        'status',
                                        'comment'
                                    ],
                                ],
                            ],
                        ],
                    ],
                ];
                $wareAccept->configs->widget = [
                    'name' => ZInputWidget::class
                ];


                $active = new Active();
                $active->type = Active::type['vertical'];
                $active->childClass = 'my-3';

                $form = $this->activeBegin($active);

                $wareAccept->configs->options = [
                    'shop_shipment_id' => [
                        'config' => [
                            'method' => 'getShipmentByCourierId',
                            'depend' => 'shop_courier_id',
                        ],
                        'event' => [
                            'change' => <<<JS
        function() {
           
$('#shop_orders').attr('src', '/shop/admin/ware-accept/orders.aspx?' + 'shop_shipment_id=' + $(this).val() + '&shop_courier_id=' + $('#wareaccept-shop_courier_id').val())
$('#shop_order_items').attr('src', '/shop/admin/ware-accept/orderItems.aspx?shop_shipment_id=' + $(this).val())
$('#refund_orders').attr('src', "/admin/ware-accept/refundOrders.aspx?id=$ware_accept_id")
           
        }
JS
                        ],
                    ]
                ];

                $this->sessionSet('shop_courier_id', $wareAccept->shop_courier_id);
                if (!empty($this->sessionGet('shop_courier_id')))
                    $wareAccept->shop_courier_id = $this->sessionGet('shop_courier_id');

                $this->sessionSet('shop_shipment_id', $wareAccept->shop_shipment_id);
                if (!empty($this->sessionGet('shop_shipment_id')))
                    $wareAccept->shop_shipment_id = $this->sessionGet('shop_shipment_id');

                //$wareAccept->configs->readonlyWidgetAll = true;
                $wareAccept->columns();

                echo ZFormBuildWidget::widget([
                    'model' => $wareAccept,
                    'form' => $form,
                    'config' => [
                        'btnTitle' => Az::l('Провести и закрыть'),
                        'botBtn' => false,
                        'stepType' => ZFormBuildWidget::stepType['none'],
                        'blockType' => ZFormBuildWidget::blockType['naked']
                    ],
                ]);

                $this->activeEnd();

                $tabData = [];

                $orderSrc = ZUrl::to([
                    '/shop/admin/ware-accept/orders',
                    'shop_shipment_id' => $wareAccept->shop_shipment_id,
                ]);

                $orderItemsSrc = ZUrl::to([
                    '/shop/admin/ware-accept/orderItems',
                    'shop_shipment_id' => $wareAccept->shop_shipment_id,
                ]);


                $tab = new TabItem();
                $tab->title = Az::l('Заказы');
                $tab->content = "<iframe id='shop_orders' class='iframe-orders' width='100%' height='auto' src='$orderSrc'></iframe>";

                $tabData[] = $tab;

                $tab = new TabItem();
                $tab->title = Az::l('Товары');
                $tab->content = "<iframe id='shop_order_items' class='iframe-orders' width='100%' height='auto' src='$orderItemsSrc'></iframe>";

                $tabData[] = $tab;

                echo ZSmartTabWidget::widget([
                    'data' => $tabData,
                ]);

                ?>
            </div>
        </div>


        <div class="row mt-3">


            <div class="col-md-8">

                <?php


                $wareResult = WareAccept::findOne($ware_accept_id);
                if ($this->modelSave($wareResult)) {
                    $this->urlRedirect([
                        'process',
                        'ware_accept_id' => $ware_accept_id
                    ]);
                }

                $wareResult->configs->nameShowEx = [
                    'id',
                    'name',
                    'date',
                    'status',
                    'shop_courier_id',
                    'shop_shipment_id',
                    'responsible',
                    'comment',
                ];
                /*
                                $wareResult->configs->rules = [
                                    'shop_courier_id' => [
                                        [
                                            'zetsoft\\system\\validate\\ZRequiredValidator'
                                        ]
                                    ],
                                ];

                                $wareResult->save();*/


                $wareResult->configs->readonlyWidgets = [
                    'currency',
                    'converted',
                ];

                $wareResult->cards = [
                    [
                        'title' => Az::l('Результат шт.'),
                        'items' => [
                            [
                                'title' => Az::l('Результат шт.'),
                                'items' => [
                                    ['completed'],
                                    ['total'],
                                    ['for_acceptance'],
                                    ['exchange'],
                                    ['refusal'],
                                    ['cancel'],
                                    ['date_transfer',]
                                ],
                            ],
                        ],
                    ],
                    [
                        'title' => Az::l('Расходы сум'),
                        'items' => [
                            [
                                'title' => Az::l('Расходы сум'),
                                'items' => [
                                    ['terminal'],
                                    ['add_delivery'],
                                    ['refund'],
                                    ['in_dollar'],
                                    ['currency'],
                                    ['converted'],
                                    ['bonus'],
                                    ['cashless',],
                                ],
                            ]
                        ],
                    ],
                    [
                        'title' => Az::l('Сумма сум'),
                        'items' => [
                            [
                                'title' => Az::l('Сумма сум'),
                                'items' => [
                                    ['sales_amount'],
                                    ['courier_reward'],
                                    ['return_expenses'],
                                    ['exchange_reward'],
                                    ['refund_reward'],
                                    ['salary_courier'],
                                    ['remain'],

                                ]
                            ],
                        ]
                    ]
                ];

                $wareResult->configs->labelType = ConfigDB::labelType['horizontal'];

                $wareResult->refund = Az::$app->market->wares->getRefund($ware_accept_id);
                $wareResult->completed = Az::$app->market->wares->getCompleted($wareAccept->shop_shipment_id);
                $wareResult->exchange = Az::$app->market->wares->getExchange($wareAccept->shop_shipment_id);
                $wareResult->total = Az::$app->market->wares->getTotal($wareAccept->shop_shipment_id);
                $wareResult->refusal = Az::$app->market->wares->getRefusal($wareAccept->shop_shipment_id);
                $wareResult->date_transfer = Az::$app->market->wares->getDateTransfer($wareAccept->shop_shipment_id);
                $wareResult->terminal = Az::$app->market->wares->getTerminal($wareAccept->shop_shipment_id);
                $wareResult->courier_reward = Az::$app->market->wares->getCourierReward($wareAccept->shop_shipment_id, $wareAccept->shop_courier_id);
                $wareResult->refund_reward = Az::$app->market->wares->getRefundReward($ware_accept_id, $wareAccept->shop_courier_id);
                $wareResult->exchange_reward = Az::$app->market->wares->getExchangeReward($wareAccept->shop_shipment_id, $wareAccept->shop_courier_id);

                $wareResult->columns();


                $active = new Active();
                $active->type = Active::type['vertical'];
                $active->childClass = 'my-2';

                $form = $this->activeBegin($active);


                echo ZFormBuildWidget::widget([
                    'model' => $wareResult,
                    'form' => $form,
                    'config' => [
                        'isCard' => false,
                        'isStepVertical' => true,
                        //'cols' => 2,
                        'btnTitle' => 'Рассчитать',
                        'botBtn' => false,
                        'stepType' => ZFormBuildWidget::stepType['card'],
                        'blockType' => ZFormBuildWidget::blockType['naked'],
                        'bodyClass' => 'd-flex'
                    ]
                ]);

                $this->activeEnd();


                ?>


            </div>


            <div class="col-md-4">


                <?

                /*echo $this->require( '/webhtm/shop/admin/ware-accept/refundOrders.php', [
                    'ware_accept_id' => $ware_accept_id,
                ]);*/

                ?>

            </div>


        </div>


    </div>
    <? require Root . '\webhtm\block\footer\footerAdmin.php' ?>

</div>


<?php $this->endBody(); ?>

</body>
</html>

<?php $this->endPage() ?>
                                      
