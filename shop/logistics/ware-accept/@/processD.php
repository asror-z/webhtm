<?php

use PhpOffice\PhpSpreadsheet\Shared\OLE\PPS\Root;
use rmrevin\yii\fontawesome\FA;
use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\data\TabItem;
use zetsoft\models\shop\ShopOrder;
use zetsoft\models\ware\WareAccept;
use zetsoft\models\ware\WareEnterItem;
use zetsoft\models\ware\WareExit;
use zetsoft\models\ware\WareExitItem;
use zetsoft\service\forms\Active;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\former\ZFormBuildWidgetD;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\inputes\ZHHiddenInputWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
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

$action->title = Azl . 'Редактирование'; /*Поступление товаров в склад*/


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
        border: none;
        min-height: 600px;
    }
</style>

<div id="page">

    <?

    require Root . '/webhtm/block/navbar/main.php';

    echo ZSessionGrowlWidget::widget();?>

    <div id="content" class="content-footer p-3">


        <div class="row">
            <div class="col-md-12">

                <?

                $id = $this->httpGet('id');

                $wareAccept = WareAccept::findOne($id);

                if ($this->modelSave($wareAccept)) {
                    $this->urlRedirect(['index', true]);
                }

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
                        'padding' => '10px',
                    ]
                ]);
                $active = new Active();
                $active->labelSpan = 1;

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
           
        }
JS
                        ],
                    ]
                ];

                if (!empty($this->sessionGet('shop_courier_id')))
                    $wareAccept->shop_courier_id = $this->sessionGet('shop_courier_id');

                if (!empty($this->sessionGet('shop_shipment_id')))
                    $wareAccept->shop_shipment_id = $this->sessionGet('shop_shipment_id');

                $wareAccept->columns();

                echo ZFormBuildWidget::widget([
                    'model' => $wareAccept,
                    'form' => $form,
                    'config' => [
                        'botBtn' => false,
                        'stepType' => ZFormBuildWidget::stepType['none'],
                        'blockType' => ZFormBuildWidget::blockType['naked']
                    ],
                ]);

                $this->activeEnd();

                ZCardWidget::end();

                $tabData = [];

                $orderSrc = ZUrl::to([
                    '/shop/admin/ware-accept/orders',
                    'shop_shipment_id' => $wareAccept->shop_shipment_id,
                ]);
                $orderItemsSrc = ZUrl::to([
                    '/shop/admin/ware-accept/orderItems',
                    'shop_shipment_id' => $wareAccept->shop_shipment_id,
                ]);
                $refundOrders = ZUrl::to([
                    '/shop/admin/ware-accept/orderItems',
                    'shop_shipment_id' => $wareAccept->shop_shipment_id,
                ]);

                $tab = new TabItem();
                $tab->title = 'Заказы';
                $tab->content = "<iframe id='shop_orders' class='iframe-orders' width='100%' height='auto' src='$orderSrc'></iframe>";

                $tabData[] = $tab;

                $tab = new TabItem();
                $tab->title = 'Товары';
                $tab->content = "<iframe id='shop_order_items' class='iframe-orders' width='100%' height='auto' src='$orderItemsSrc'></iframe>";

                $tabData[] = $tab;

                $tab = new TabItem();
                $tab->title = Az::l('Группа ');
                $tab->content = "<iframe id='shop_order_items' class='iframe-orders' width='100%' height='auto' src='$orderItemsSrc'></iframe>";

                $tabData[] = $tab;

                echo ZSmartTabWidget::widget([
                    'data' => $tabData,
                ])

                ?>
            </div>
        </div>


        <div class="row mt-3">


            <div class="col-md-12">

                <?php

                $this->pjaxBegin();

                $id = $this->httpGet('id');
                $wareResult = WareAccept::findOne($id);

                if ($this->modelSave($wareResult)) {
                    $this->urlRedirect(['index', true]);
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

                $wareResult->configs->readonlyWidgets = [
                    'currency',
                    'converted',
                ];

                $wareResult->configs->hasLabel = true;

                ZCardWidget::begin([
                    'config' => [
                        'title' => Az::l('Итоги'),
                        'type' => ZCardWidget::type['dynCard'],
                    ]
                ]);

                $active = new Active();
                $active->id = 'pjaxForm';
                $active->type = Active::type['vertical'];


                $form = $this->activeBegin($active);


                $wareResult->cards = [
                    [
                        'title' => Az::l('Первый этап'),
                        'items' => [

                            [
                                'title' => Az::l('Результат шт.'),
                                'items' => [
                                    [
                                        'completed',
                                        'total',
                                        'for_acceptance',
                                        'exchange',
                                        'refusal',
                                        'cancel',
                                        'date_transfer',
                                    ],
                                ],
                            ],
                            [
                                'title' => Az::l('Расходы сум'),
                                'items' => [
                                    [
                                        'terminal',
                                        'add_delivery',
                                        'refund',
                                        'in_dollar',
                                        'currency',
                                        'converted',
                                        'bonus',
                                        'cashless',
                                    ],
                                ],
                            ],
                            [
                                'title' => Az::l('Сумма сум'),
                                'items' => [
                                    [

                                        'sales_amount',
                                        'courier_reward',
                                        'return_expenses',
                                        'exchange_reward',
                                        'refund_reward',
                                        'salary_courier',
                                        'remain',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ];

                $wareResult->columns();

                echo ZFormBuildWidget::widget([
                    'model' => $wareResult,
                    'form' => $form,
                    'config' => [
                        'cols' => 3,
                       
                        'botBtn' => false,
                        'stepType' => ZFormBuildWidget::stepType['none'],
                        'blockType' => ZFormBuildWidget::blockType['card'],
                        'bodyClass' => 'd-flex'

                    ]
                ]);

//                echo ZButtonWidget::widget([
//                    'config' => [
//                        'text' => Az::l('Рассчитать'),
//                        'btnStyle' => ZButtonWidget::btnStyle['btn-outline-success'],
//                        'btnSize' => ZButtonWidget::btnSize['btn-md'],
//                        'btnRounded' => true,
//                        'btnType' => ZButtonWidget::btnType['submit'],
//                        'icon' => 'fa fa-' . FA::_CALCULATOR,
//                        'name' => 'submitBtn',
//                        'class' => 'rounded text-muted d-block mx-auto w-50 mt-4  mb-3',
//                    ],
//                    'event' => [
//                        'click' => <<<JS
//            function() {
//
//                 $.ajax({
//                    url: 'calculate.aspx?id={$id}',
//                    type: 'POST',
//                    data: $('#pjaxForm').serialize(),
//                    success: function() {
//                        $('#pjaxForm').submit()
//                    }
//
//                 })
//
//            }
//JS,
//
//                    ]
//                ]);

                $this->activeEnd();

                ZCardWidget::end();


                $this->pjaxEnd();

                ?>


            </div>


            <div class="col-md-5">



            </div>

        </div>


    </div>

</div>
<script>
    $('#wareaccept-in_dollar').on('change', function () {
        $.ajax({
            method: "POST",
            url: "/api/currency/index.aspx",
            data: {amount: $(this).val()}
        })
            .done(function (msg) {
                $('#wareaccept-currency').val(msg['currency'])
                $('#wareaccept-converted').val(msg['amount'])
            });
    })
</script>

<?php $this->endBody(); ?>

</body>
</html>

<?php $this->endPage() ?>
