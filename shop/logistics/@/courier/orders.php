<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\shop\ShopOrder;
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
/*require Root . '/webhtm/block/navbar/mainAdmin.php';
require Root . '/webhtm/block/menu/menu-m.php';*/
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
            <div class="col-md-12 col-12">

                <?

                $shop_shipment_id = $this->httpGet('shop_shipment_id');
                $shop_courier_id = $this->httpGet('shop_courier_id');

                $this->sessionSet('shop_shipment_id', $shop_shipment_id);
                $this->sessionSet('shop_courier_id', $shop_courier_id);

                $model = new ShopOrder();
                $model->configs->query = ShopOrder::find()
                    ->where([
                        'shop_shipment_id' => $shop_shipment_id,
                    ]);
                if($model->accepted)
                {
                    $model->configs->readonly = true;
                }
                $model->configs->nameOn = [
                    'id',
                    'name',
                    'code',
                    'date_deliver',
                    'status_accept',
                    'delayed_deliver_date',
                    'price',
                    'deliver_price',
                    'total_price',
                    'shop_reject_cause_id',
                    'additional_deliver',
                    'additional_received_money',
                    'additional_payment_type',
//                  'delayed_deliver_cause',
                ];
                
                $model->configs->width = [
                    'deliver_price' => '100px',
                    'price' => '100px',
                ];
                
                $model->columns();

                $status = ZCheckSelectWidget::widget([
                    'config' => [
                        'widgetClass' => ZSelect2Widget::class,
                        'widgetOptions' => [
                            'data' => $model->_status_accept
                        ],
                        'btnOptions' => [
                            'config' => [
                                'text' => Az::l('Применить'),
                                'btnRounded' => false,
                                'class' => 'btn-sm mx-0'
                            ]
                        ],
                        'url' => ZUrl::to([
                            '/api/core/app/check',
                            'modelClassName' => $model->className
                        ]),

                        'message' => null,
                        /* 'hasIcon' => true,*/
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

                $testArr = ShopOrder::find()
                    ->where([
                        'shop_shipment_id' => $shop_shipment_id,
                    ])
                    ->andWhere([
                        'status_accept' => null
                    ])
                    ->all();

                $orders = ZArrayHelper::map($testArr, 'id', 'id');

                $numbers = [];
                foreach ($orders as $order) {
                    $numbers[] = $order;
                }



                /** @var ZView $this */
                echo ZDynaWidget::widget([

                    'model' => $model,
                    'rightBtn' => [
                        'add-tabular-clone-delete' => [
                            'content' => "{add}",
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
                                'class' => 'w-50 p-1 mx-2 {btnSize} {iconSize}'
                            ]
                        ],

                    ],
                    'config' => [
                        'hasToolbar' => false,
                        'isCard' => false,
                        'numbers' => $numbers,
                        'twoCheck' => true,
                        'spaHeight' => [
                            'create' => '800px'
                        ],
                       
                        'spa' => true,
                        'createUrlAjax' => ZUrl::to([
                            'create-process-item',
                            'id' => $this->httpGet('order_id'),
                        ]),
                        'createUrl' => 'create-item',
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

                $jsNumbers = '[]';
                if (!empty($numbers))
                    $jsNumbers = $this->jscode($numbers);
                ?>

            </div>
        </div>
    </div>
</div>

<script>

    var numbers = <?=$jsNumbers?>;
    window.ajaxFor = function () {
        $.ajax({
            url: '/api/orders/ravshan.aspx',
            data: {
                shop_shipment_id: <?=$shop_shipment_id?>
            },
            success: function (response) {
                numbers = response.numbers;
            }
        })
    }

    $(document).on('change', '.checkBox-dynawidget-new', function (event) {

        var trs = $('.tr-dynawidget');

        trs.each(function (key, value) {

            var values = $(value).attr('data-key');
            var integers = parseInt(values)

            if (numbers.includes(integers)) {
                $(this).click()
            }
        });

    });


</script>
<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>


