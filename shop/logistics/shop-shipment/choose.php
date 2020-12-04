<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\shop\ShopCourier;
use zetsoft\models\shop\ShopOrder;
use zetsoft\models\shop\ShopShipment;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\helpers\ZVarDumper;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZCheckButtonWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZGetChecksWidget;
use zetsoft\widgets\menus\ZMmenuWidgetSh;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\place\PlaceCountry;


/** @var ZView $this */


/**
 *
 * Action Params
 * @author MurodovMirbosit
 */

$action = new WebItem();

$action->title = Azl . 'Подобрать заказ';
$action->icon = 'fal fa-line-chart';
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

<div class="p-3">

    <?

    echo ZSessionGrowlWidget::widget(); ?>

    <div class="p-2 row justify-content-end dynaCheck">

        <?php

        $date_deliver = $this->httpGet('date_deliver');
        $shop_shipment_id = $this->httpGet('shop_shipment_id');

        $shipment = ShopShipment::findOne($shop_shipment_id);

        $shop_courier = ShopCourier::findOne($shipment->shop_courier_id);
        $place_region_ids = $shop_courier->place_region_ids;

        $model = new ShopOrder();
        
        ?>

    </div>
    <div class="row">
        <div class="col-md-12 col-12">

            <?php

            /** @var ZView $this */

            $model->configs->query = ShopOrder::find()
                ->where([
                    'shop_shipment_id' => null,
                    'status_logistics' => ShopOrder::status_logistics['shipment_ready'],
                    'place_region_id' => $place_region_ids,
                    'date_deliver' => $date_deliver
                ]);

            $model->configs->readonly = true;

            $model->configs->nameOn = [
                'number',
                'name',
                'user_id',
                'place_adress_id',
                'place_region_id',
                'status_logistics',
                'date_deliver',
                'delayed_deliver_date',
            ];
            $model->configs->changeReload = true;
            $model->columns();

            $checkUrl = ZUrl::to([
                '/api/shop/orders/shipment',
                'shop_shipment_id' => $shop_shipment_id,
            ]);

            echo ZDynaWidget::widget([
                'model' => $model,
                'rightNameEx' => [
                    'system'
                ],
                'leftBtn' => [
                    'update' => [
                        'content' => ZGetChecksWidget::widget([
                            'model' => $model,
                            
                            'config' => [
                                'url' => $checkUrl,
                                'btnOptions' => [
                                    'config' => [
                                        'icon' => '',
                                        'isPjax' => false,
                                        'text' => Az::l('Подобрать'),
                                        'hasIcon' => false,
                                        'btnType' => ZButtonWidget::btnType['link'],
                                        'grapes' => false,
                                        'btnStyle' => ZButtonWidget::btnStyle['btn-transparent'],
                                        'btnSize' => ZButtonWidget::btnSize['btn-mini'],
                                        'class' => 'rounded-0',
                                        'title' => Az::l('Подборка'),
                                        'message' => Az::l('Вы хотите подобрать эти элементы?'),
                                    ]
                                ]
                            ],
                            'event' => [
                                'ajaxSuccess' => <<<JS
             function() {
                 window.parent.location.reload()    
             }
JS,
                            ]
                        ]),
                        'options' => [
                            'class' => 'btn-group p-1 {btnSize} {iconSize}'
                        ]
                    ],
                ],
                'config' => [
                    'isCard' => false,
                    'hasItems' => false,
                    'columnBefore' => [
                        'checkbox',
                        'serial',
                        'id'
                    ],
                    'columnAfter' => false,
                    'hasToolbar' => false,
                    'search' => false,
                    'heighbody' => '62vh',
                ]
            ]);

            ?>

        </div>
    </div>


</div>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
