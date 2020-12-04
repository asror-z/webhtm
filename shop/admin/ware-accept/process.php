<?php

use PhpOffice\PhpSpreadsheet\Shared\OLE\PPS\Root;
use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\data\ConfigDB;
use zetsoft\dbitem\data\TabItem;
use zetsoft\former\core\CoreAcceptForm;
use zetsoft\models\ware\WareAccept;
use zetsoft\service\forms\Active;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\inputes\ZKSelect2Widget;
use zetsoft\widgets\navigat\ZSmartTabWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\themes\ZTabWidget;


/** @var ZView $this */


/**
 *
 * Action Params
 * @author MurodovMirbosit
 */

$action = new WebItem();

$action->title = Azl . 'Приёмка от курьера';


$action->icon = 'fal fa-film';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = false;
$action->loader = true;
$action->layout = true;
$action->layoutFile = 'admin';
$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

?>

<style>
    .iframe-orders {
        border: none;
        height: 100vh;
    }
</style>


<div id="content" class="content-footer p-3">

    <div class="row">
        <div class="col-md-12 col-12">

            <?php

            $ware_accept_id = $this->httpGet('ware_accept_id');

            $wareAccept = WareAccept::findOne($ware_accept_id);

            $wareAccept->configs->hasLabel = true;

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
                                ],
                                [
                                    'comment',
                                ]
                            ],
                        ],
                    ],
                ],
            ];

            $wareAccept->configs->widget = [
                'shop_shipment_id' => ZKSelect2Widget::class
            ];
            //start: MurodovMirbosit 09.10.2020
            $wareAccept->configs->options = [
                'status' => [
                    'active' => [
                        'change' => true,
                    ],
                    'event' => [
                        'change' => <<<JS
                   
                           if (this.value === 'generate_doc'){
                               $('#secondaryWareAccept').click()
                           }
                        
JS,
                    ],
                ]
            ];
            //end
            $wareAccept->configs->changeSave = true;
            $wareAccept->columns();

            if ($this->modelSave($wareAccept)) {
                $wareAccept->closed = true;
                $wareAccept->save();
                $this->urlRedirect([
                    'index',
                ]);
            }

            $active = new Active();
            $active->type = Active::type['vertical'];
            $active->childClass = 'my-3';

            $form = $this->activeBegin($active);

            echo ZFormBuildWidget::widget([
                'model' => $wareAccept,
                'form' => $form,
                'config' => [
                    'topBtn' => true,
                    'btnTitle' => Az::l('Провести и закрыть'),
                    'botBtn' => false,
                    'stepType' => ZFormBuildWidget::stepType['none'],
                    'blockType' => ZFormBuildWidget::blockType['naked'],
                ],
            ]);

            $this->activeEnd();

            $tabData = [];

            $orderSrc = ZUrl::to([
                '/shop/admin/ware-accept/orders',
                'ware_accept_id' => $ware_accept_id,
                'shop_shipment_id' => $wareAccept->shop_shipment_id,
                'shop_courier_id' => $wareAccept->shop_courier_id,
            ]);

            $orderItemsSrc = ZUrl::to([
                '/shop/admin/ware-accept/orderItems',
                'ware_accept_id' => $ware_accept_id,
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

            echo ZTabWidget::widget([
                'data' => $tabData,
                'config' => [
                    'type' => ZTabWidget::type['classic'],
                    'mdTabColor' => ZTabWidget::mdTabColor['white'],
                    'classicTabColor' => ZTabWidget::classicTabColor['tabs-light'],

                ],
            ]);


            ?>

        </div>

    </div>

    <div class="row justify-content-center">

        <div class="col-md-12">

            <?php
            $wareResult = new CoreAcceptForm();
            if ($this->formModel($wareResult) === true) {

                $wareAccept->status = 'generate_doc';
                $wareAccept->configs->rules = validatorSafe;

                $wareAccept->save();

                $this->urlRedirect([
                    'process',
                    'ware_accept_id' => $ware_accept_id
                ]);

            }

            $wareResult->configs->hasLabel = true;
            $wareResult->configs->hasPlaceholder = false;
            $wareResult->configs->labelSpan = 8;

            $wareResult->cards = [
                [
                    'title' => Az::l('Результат шт.'),
                    'items' => [
                        [
                            'title' => Az::l('Результат шт.'),
                            'items' => [
                                ['completed', 'completed_all'],

                                ['for_acceptance',],

                                ['refusal', 'cancel'],

                                ['date_transfer', 'exchange'],

                                ['total']
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

                                ['terminal', 'add_delivery'],

                                ['refund', 'in_dollar'],

                                ['currency', 'converted'],

                                ['isBonus', 'bonus', 'cashless'],

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
                                ['sales_amount', 'courier_reward'],

                                ['return_expenses', 'exchange_reward'],

                                ['refund_reward', 'salary_courier'],

                                ['remain'],
                            ]
                        ],
                    ]
                ]
            ];

            $wares = Az::$app->market->wares;
            $wareResult->configs->labelType = ConfigDB::labelType['vertical'];
            //wareResult
            $wareResult->refund = $wares->getRefund($wareAccept);
            $wareResult->cancel = $wares->getCancel($wareAccept->shop_shipment_id);
            $wareResult->completed = $wares->getCompleted($wareAccept->shop_shipment_id);
            $wareResult->completed_all = $wares->getCompletedAll($wareAccept->shop_shipment_id);
            $wareResult->exchange = $wares->getExchange($wareAccept->shop_shipment_id);
            $wareResult->add_delivery = $wares->getAddDelivery($wareAccept->shop_shipment_id);
            $wareResult->total = $wares->getTotal($wareAccept->shop_shipment_id);
            $wareResult->refusal = $wares->getRefusal($wareAccept->shop_shipment_id);
            $wareResult->date_transfer = $wares->getDateTransfer($wareAccept->shop_shipment_id);
            $wareResult->terminal = $wares->getTerminal($wareAccept->shop_shipment_id);
            $wareResult->cashless = $wares->getCashless($wareAccept->shop_shipment_id);
            $wareResult->sales_amount = $wares->getSalesAmount($wareAccept->shop_shipment_id);
            $wareResult->courier_reward = $wares->getCourierReward($wareAccept->shop_shipment_id, $wareAccept->shop_courier_id);
            //wareResult
            $wareResult->refund_reward = $wares->getRefundReward($wareAccept, $wareAccept->shop_courier_id);
            $wareResult->exchange_reward = $wares->getExchangeReward($wareAccept->shop_shipment_id, $wareAccept->shop_courier_id);
            //wareResult
            $wareResult->salary_courier = $wares->getSalaryCourier($wareResult);
            $wareResult->remain = $wares->getRemain($wareResult);

            //start: MurodovMirbosit 01.10.2020
            if ($wareResult->remain < 0) {
                ?>
                <script>
                    $(document).on('pjax:end', function () {
                        Swal.fire({
                            title: 'Общий остаток равно или меньше нуля',
                            showCloseButton: false,
                            showCancelButton: false,
                        });
                    });
                    $(document).ready(function () {
                        Swal.fire({
                            title: 'Общий остаток равно или меньше нуля',
                            showCloseButton: false,
                            showCancelButton: false,
                        });
                    });
                </script>
                <?php
                $wareResult->remain = $wares->getRemain($wareResult);
            }
            //end

            $wareResult->columns();

            $wareAccept->setAttributes($wareResult->attributes);
            $wareAccept->save();

            $active = new Active();
            $active->type = Active::type['vertical'];
            $active->childClass = 'my-2';

            $this->pjaxBegin();

            $form = $this->activeBegin($active);

            echo ZFormBuildWidget::widget([
                'model' => $wareResult,
                'form' => $form,
                'config' => [
                    'isCard' => true,
                    'isStepVertical' => true,
                    'btnTitle' => 'Рассчитать',
                    'botBtn' => false,
                    'parentClass' => 'd-flex justify-content-around',
                    'stepType' => ZFormBuildWidget::stepType['card'],
                    'blockType' => ZFormBuildWidget::blockType['naked'],
                ]
            ]);

            $this->activeEnd();

            $this->pjaxEnd();

            ?>
        </div>
    </div>

    <div class="col-md-12">
        <?php
        echo $this->require('/webhtm/shop/admin/ware-accept/return-items.php', ['ware_accept_id' => $ware_accept_id,]);
        ?>
    </div>

</div>

<script>

    function setSumma() {
        var currency = $(document).find('#acceptform-currency').val();
        var in_dollar = $(document).find('#acceptform-in_dollar').val();

        var summa = parseInt(currency) * parseInt(in_dollar);

        $(document).find('#acceptform-converted').val(summa);
    }

    function setBonus() {

        var bonus = $(document).find('#acceptform-bonus').val();
        var oldSalary = $(document).find('#acceptform-salary_courier').val();

        var summa = parseInt(bonus) + parseInt(oldSalary);

        $(document).find('#acceptform-salary_courier').val(summa);

    }

    setSumma();

    $(document).on('pjax:end', function () {

        setSumma();

    });

    $(document).on('keyup', '#acceptform-in_dollar', function () {

        $.ajax({
            url: '/api/shop/orders/accept.aspx',
            data: {
                value: $(this).val(),
                currency: $(document).find('#acceptform-currency').val(),
            },
            success: function (response) {

                $(document).find('#acceptform-converted').val(response.value);

            },
        });

    });

</script>

