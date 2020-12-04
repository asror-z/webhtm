<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\shop\ShopOrder;
use zetsoft\models\ware\WareAccept;
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
 */

$action = new WebItem();

$action->title = Azl . 'Редактирование'; /*Поступление товаров в склад*/
$action->icon = 'fal fa-film';
$action->type = WebItem::type['html'];
$action->debug = false;
$action->loader = false;
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

                $ware_accept_id = $this->httpGet('ware_accept_id');
                $ware_accept = WareAccept::findOne($ware_accept_id);

                $shop_shipment_id = $ware_accept->shop_shipment_id;

                $model = new ShopOrder();
                $model->configs->query = ShopOrder::find()
                    ->where([
                        'shop_shipment_id' => $shop_shipment_id,

                    ]);

                $model->configs->nameOn = [
                    'number',
                    'name',
                    'code',
                    'date_deliver',
                    'status_accept',
                    'delayed_deliver_date',
                    'total_price',
                    'price',
                    'deliver_price',
                    'shop_reject_cause_id',
                    'additional_deliver',
                    'additional_received_money',
                    'additional_payment_type',
                ];

                $model->configs->width = [
                    'deliver_price' => '100px',
                    'price' => '100px',
                ];

                $model->configs->pageSize = 60;

                $model->columns();

                $status = ZCheckSelectWidget::widget([
                    'config' => [
                        'Colclass' => 'm-2',
                        'btnClass' => 'col-3',
                        'widgetClass' => ZSelect2Widget::class,
                        'widgetOptions' => [
                            'data' => $model->_status_accept,
                            'config' => [
                                'placeholder' => Az::l('Изменить статус выбранных заказов'),
                                'ajax' => false,
                            ],
                        ],
                        'btnOptions' => [
                            'config' => [
                                'text' => Az::l('Применить'),
                                'btnRounded' => false,
                                'class' => 'btn-sm mx-0'
                            ]
                        ],
                        'url' => ZUrl::to([
                            '/api/core/dyna/check',
                            'modelClassName' => $model->className
                        ]),

                        'message' => null,
                        'buttonId' => 'id',
                        'timeout' => 4000,
                        'modelClassName' => $model->className,
                        'attr' => 'status_accept',
                    ],
                    'event' => [
                        'ajaxSuccess' => <<<JS
                function () {
                   location.reload()
                }
JS,
                    ]
                ]);

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
                    'leftBtn' => [
                        'check' => [
                            'content' => $status,
                            'options' => [
                                'class' => 'p-1 mx-2 {btnSize} {iconSize}'
                            ]
                        ],
                        'search' => [
                            'content' => '',
                            'options' => ['class' => ' p-1 mr-0 {btnSize} {iconSize}']
                        ],

                    ],
                    'config' => [
                        'barCode' => true,
                        'hasToolbar' => false,
                        'isCard' => false,
                        'twoCheck' => true,
                        'checkboxOptions' => [
                            'query' => [
                                'shop_shipment_id' => $shop_shipment_id,
                                'status_accept' => null
                            ],
                            'orQuery' => [
                                'shop_shipment_id' => $shop_shipment_id,
                                'status_accept' => ''
                            ],
                            'url' => '/api/shop/orders/ravshan.aspx'
                        ],
                        'columnBefore' => [
                            'serial',
                            'checkbox',
                        ],
                        'columnAfter' => false,
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


