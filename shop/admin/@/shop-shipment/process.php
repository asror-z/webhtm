<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\place\PlaceAdress;
use zetsoft\models\shop\ShopCourier;
use zetsoft\models\shop\ShopShipment;
use zetsoft\models\shop\ShopOrder;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZCheckButtonWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZFormWidget;
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

$action->title = Azl . 'Редактирование';  /*Поступление товаров в склад*/


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

<div id="page">

    <?

    require Root . '/webhtm/block/navbar/main.php';

    echo ZSessionGrowlWidget::widget();?>

    <div id="content" class="content-footer p-3">


        <div class="row">

            <div class="col-md-12 col-12">

                <?php

                $id = $this->httpGet('id');
                $shipment = ShopShipment::findOne($id);

                $courier_id = $shipment->shop_courier_id;
                if (!empty($this->sessionGet('courier_id')))
                    $courier_id = $this->sessionGet('courier_id');

                ZCardWidget::begin([
                    'config' => [
                        'title' => Az::$app->view->title,
                        'type' => ZCardWidget::type['dynCard'],
                    ]
                ]);

                $form = $this->activeBegin();

                if ($this->modelSave($shipment)) {
                    $this->urlRedirect(['index', true]);
                }

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
                $shipment->columns();

                echo ZFormWidget::widget([
                    'model' => $shipment,
                    'form' => $form,
                ]);

                $this->activeEnd();

                ZCardWidget::end();


                $model = new ShopOrder();

                $shop_courier = ShopCourier::findOne($courier_id);
                $place_region_id = Az::$app->market->courier->placeAdress($shop_courier);

                $place_address = PlaceAdress::findOne([
                    'place_region_id' => $place_region_id
                ]);

                $model->configs->query = ShopOrder::find()
                    ->where([
                        'shop_shipment_id' => $shipment->id,
                        'place_adress_id' => $place_address->id
                    ]);
                $model->configs->dynaButtons = [
                    'add-tabular-clone-delete' => [
                        'content' => '{choose}',
                        'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                    ],

                ];
                $model->columns();

                echo ZDynaWidget::widget([
                    'model' => $model,
                    'config' => [
                        'hasToolbar' => true,
                        'spa' => true,
                        'title' => Az::l('Подобранные заказы'),
                        'search' => false,
                        'headerIcon' => '',
                        'bordered' => false,
                        'columnBefore' => [
                            'serial',
                            'radio',
                            'id'
                        ],
                        
                    ]

                ]);


                $courier = ShopCourier::findOne($courier_id);
                echo ZSweetAlert2Widget::widget([
                    'config' => [
                        'allowOutsideClick' => false,
                        'title' => Az::l("Подобрать заказы для курьера $courier->name"),
                        'iframeId' => 'process-order',
                        'funcName' => 'orderSweet',
                        'url' => ZUrl::to([
                            'orders',
                            'shop_courier_id' => $courier_id,
                            'shipment_id' => $shipment->id
                        ]),
                        'height' => '900px',
                        'width' => '1200px',
                    ]
                ])


                ?>

            </div>

        </div>

    </div>

</div>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
