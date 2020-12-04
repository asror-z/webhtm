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
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\models\ware\WareEnter;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Редактирование Поступление товаров в склад';


$action->icon = 'fal fa-film';
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

        <div class="p-2 row justify-content-end dynaCheck">

            <?

            $shipment_id = $this->httpGet('shipment_id');
            $shipment = ShopShipment::findOne($shipment_id);

            if ($this->modelSave($model)) {
                $this->urlRedirect(['index', true]);
            }

            $shop_courier = ShopCourier::findOne($this->httpGet('shop_courier_id'));
            $place_region_id = Az::$app->market->courier->placeAdress($shop_courier);

            $place_address = PlaceAdress::findOne([
                'place_region_id' => $place_region_id
            ]);


            echo ZCheckButtonWidget::widget([
                
                'config' => [
                    'icon' => '',
                    'text' => Az::l('Подобрать'),
                    'hasIcon' => false,
                    'btnType' => ZButtonWidget::btnType['link'],
                    'grapes' => false,
                    'btnStyle' => ZButtonWidget::btnStyle['btn-outline-primary'],
                    'url' => ZUrl::to([
                        'shipment',
                        'shipment_id' => $shipment_id
                    ]),
                    'title' => 'Клонировать?',
                    'class' => 'checkbox-ShopOrder',
                    'message' => Az::l('Вы хотите клонировать этот элемент(ы)?'),
                    'modelClassName' => 'ShopOrder'
                ],
                'event' => [
                    'ajaxSuccess' => <<<JS
                     function() {
                         window.parent.closeSweet()
                         window.parent.location.reload()    
                     }
JS,

                ]

            ]);

            ?>

        </div>
        <div class="row">
            <div class="col-md-12">

                <?php

                
                $model = new ShopOrder();
                $model->configs->query = ShopOrder::find()
                    ->where([
                        'status_client' => 'accepted',
                        'place_adress_id' => $place_address->id,
                        'shop_shipment_id' => null
                    ]);

                $model->configs->readonly = true;
                $model->columns();

                echo ZDynaWidget::widget([
                    'model' => $model,
                    'rightNameEx' => [
                        'system'
                    ],
                    'config' => [
                        'isCard' => false,
                        'hasToolbar' => false,
                        'spa' => true,
                        'reloadUrl' => ZUrl::to([
                            'process',
                            'id' => $this->httpGet('id')
                        ]),
                        'title' => Az::l('Подобрать заказы'),
                        'search' => false,
                        'headerIcon' => '',
                        'width' => 'auto',
                        'columnBefore' => [
                            'serial',
                            'id'
                        ],
                        'columnAfter' => null
                    ]

                ]);

                ?>

            </div>
        </div>

        <div class="p-2 row justify-content-end dynaCheck">

            <?

            echo ZCheckButtonWidget::widget([
                
                'config' => [
                  
                    'icon' => '',
                    'text' => Az::l('Подобрать'),
                    'hasIcon' => false,
                    'btnType' => ZButtonWidget::btnType['link'],
                    'grapes' => false,
                    'btnStyle' => ZButtonWidget::btnStyle['btn-outline-primary'],
                    'url' => ZUrl::to([
                        'shipment',
                        'shipment_id' => $shipment_id
                    ]),
                    'title' => 'Клонировать?',
                    'class' => 'checkbox-ShopOrder',
                    'message' => Az::l('Вы хотите клонировать этот элемент(ы)?'),
                    'modelClassName' => 'ShopOrder'
                ],
                'event' => [
                    'ajaxSuccess' => <<<JS
                     function() {
                         window.parent.closeSweet()
                         window.parent.location.reload()    
                     }
JS,
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
