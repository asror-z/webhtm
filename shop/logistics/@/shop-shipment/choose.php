<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\shop\ShopOrder;
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

    echo ZSessionGrowlWidget::widget();?>


    <div class="p-2 row justify-content-end dynaCheck">

        <?

        $parentQuery = $this->httpGet('parentQuery');
        $query = $this->httpGet('chooseQuery');
        $date_deliver = $this->httpGet('date_deliver');
        $shop_shipment_id = $this->httpGet('shop_shipment_id');
        $place_region_id = $this->httpGet('place_region_id');

        $query = json_decode($query, true, 512);

        $query = ZVarDumper::arrayFilter($query, true);

        $model = new ShopOrder();

        $checkUrl = ZUrl::to([
            '/api/shop/orders/shipment',
            'shop_shipment_id' => $shop_shipment_id,
            'query' => $query,
            'parentQuery' => ZArrayHelper::getValue($parentQuery, 'where')
        ]);


        echo ZCheckButtonWidget::widget([
            'model' => $model,
            
            'config' => [
                'icon' => '',
                'isPjax' => false,
                'text' => Az::l('Подобрать'),
                'hasIcon' => false,
                'btnType' => ZButtonWidget::btnType['link'],
                'grapes' => false,
                'btnStyle' => ZButtonWidget::btnStyle['btn-transparent'],
                'btnSize' => ZButtonWidget::btnSize['btn-mini'],
                'url' => $checkUrl,
                'class' => 'rounded-0',
                'title' => Az::l('Подборка'),
                'message' => Az::l('Вы хотите подобрать эти элементы?'),
            ],
            'event' => [
                'ajaxSuccess' => <<<JS
                     function() {
                         window.parent.location.reload()    
                     }
JS,
            ]

        ]);

        ?>

    </div>
    <div class="row">
        <div class="col-md-12 col-12">

            <?
            /** @var ZView $this */

            $model->configs->query = ShopOrder::find()->
            where([
               'status_logistics' => ShopOrder::status_logistics['shipment_ready'],
               'shop_shipment_id' => null,
               'place_region_id' => $place_region_id
            ])->andWhere([
                'or',
                ['date_deliver' => $date_deliver],
                ['delayed_deliver_date' => $date_deliver]
            ]);
            $model->configs->readonly = true;
            $model->configs->nameOn = [
                'id',
                'name',
                'user_id',
                'place_adress_id',
                'delayed_deliver_date',
                'date_deliver',
                'status_client',
            ];

            $model->columns();

            echo ZDynaWidget::widget([
                'model' => $model,
                'rightNameEx' => [
                    'system'
                ],
                'config' => [
                    'isCard' => false,
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
