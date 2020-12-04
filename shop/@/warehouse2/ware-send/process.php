<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\place\PlaceAdress;
use zetsoft\models\shop\ShopCourier;
use zetsoft\models\shop\ShopShipment;
use zetsoft\models\shop\ShopOrder;
use zetsoft\service\forms\Active;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZCheckButtonWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\inputes\ZInputWidget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\notifier\ZSweetAlert2Widget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\models\ware\WareEnter;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Назначение заказов курьеру';


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

<div id="page">

    <?

    require Root . '/webhtm/block/navbar/admin.php';

    echo ZSessionGrowlWidget::widget();?>

    <div id="content" class="content-footer p-3">


        <div class="row">

            <div class="col-md-12 mx-auto">

                <?php

                $shop_shipment_id = $this->httpGet('shop_shipment_id');

                $shipment = ShopShipment::findOne($shop_shipment_id);

                $courier_id = $shipment->shop_courier_id;
                if (!empty($this->sessionGet('courier_id')))
                    $courier_id = $this->sessionGet('courier_id');

                if ($this->modelSave($shipment)) {
                    $this->urlRedirect(['index', true]);
                }

                $shipment->configs->readonlyWidgetOff = [
                    'comment'
                ];

                $shipment->configs->widget = [
                    'date' => ZInputWidget::class,
                    'date_deliver' => ZInputWidget::class,
                ];

                $shipment->shop_courier_id = $courier_id;
                $shipment->configs->options = [
                    'shop_courier_id' => [
                        'event' => [
                            'select' => <<<JS
                                function() {
                                     
                                     $.ajax({
                                        method: 'GET',
                                        url: '/seller/shop-shipment/session.aspx',
                                        data: {
                                            courier_id: $(this).val()
                                        },
                                        success: function() {
                                            location.reload()
                                        }
                                     })   
                            
                                }
JS,
                        ]
                    ]
                ];
                $shipment->cards = [
                    [
                        'title' => Az::l('Первый этап'),
                        'items' => [
                            [
                                'title' => Az::l('Форма'),
                                'items' => [
                                    [
                                        'date',
                                        'date_deliver',
                                    ],
                                    [
                                        'shipment_type',
                                        'shop_courier_id'
                                    ],
                                    [
                                        'responsible',
                                        'comment',
                                    ],
                                    [
                                        'ware_place_ids',
                                        'user_place_ids'
                                    ]
                                ],
                            ],
                        ],
                    ]
                ];

                $shipment->columns();

                $active = new Active();
                $active->type = Active::type['vertical'];
                $active->childClass = 'my-3';

                ZCardWidget::begin([
                    'config' => [
                        'title' => Az::$app->view->title,
                        'type' => ZCardWidget::type['dynCard'],
                    ]
                ]);

                $form = $this->activeBegin($active);

                echo ZFormBuildWidget::widget([
                    'model' => $shipment,
                    'form' => $form,
                    'config' => [
                        'btnTitle' => Az::l('Провести и закрыть'),
                        'stepType' => ZFormBuildWidget::stepType['none'],
                        'blockType' => ZFormBuildWidget::blockType['naked'],
                        'botBtn' => false,
                    ]
                ]);

                $this->activeEnd();

                ZCardWidget::end();


                ?>

            </div>


            <div class="mt-5 mx-auto col-md-12">

                <?
                $model = new ShopOrder();

                $shop_courier = ShopCourier::findOne($courier_id);

                $place_region_id = Az::$app->market->courier->placeAdress($shop_courier);

                $model->configs->query = ShopOrder::find()
                    ->where([
                        'shop_shipment_id' => $shipment->id,
                        'status_logistics' => ShopOrder::status_logistics['courier_appointment']
                    ])
                    ->andWhere(['!=', 'status_logistics', ShopOrder::status_logistics['delivery_transfer']]);

                $model->configs->nameOn = [
                    'id',
                    'name',
                    'responsible',
                    'payment_type',
                    'created_at',
                    'shop_channel_id',
                    'user_id',
                    'date_deliver',
                    'status_logistics',
                    'place_adress_id',
                ];

                $model->configs->dynaButtons = [
                    'add-tabular-clone-delete' => [
                        'content' => '{choose}{delete}',
                        'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                    ],

                ];

                $model->columns();
                echo ZDynaWidget::widget([
                    'model' => $model,
                    'config' => [
                        'deleteAllUrl' => '/api/orders/deleteShipment.aspx',
                        'spaHeight' => [
                            'create' => '700px',
                            'choose' => '800px'
                        ],
                        'spaWidth' => [
                            'create' => '700px',
                            'choose' => '900px'
                        ],
                       /*'chooseUrl' => ZUrl::to([
                            'choose',
                            'date_deliver' => $shipment->date_deliver,
                            'shop_shipment_id' => $shop_shipment_id,
                            'place_region_id' => $place_region_id,
                        ]),*/

                        'hasToolbar' => false,
                        'spa' => true,
                        'title' => Az::l('Подобранные заказы'),
                        'search' => false,
                        'headerIcon' => '',
                        'bordered' => false,
                        'columnBefore' => [
                            'checkbox',
                            'serial',
                            'id'
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
