<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\shop\ShopOrder;
use zetsoft\models\shop\ShopOrderItem;
use zetsoft\models\ware\WareReturn;
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
 */

$action = new WebItem();

$action->title = Azl . 'Подобрать товары для переноса даты доставки';
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

        <?php

        $ware_return_id = $this->httpGet('ware_return_id');
        $ware_return = WareReturn::findOne($ware_return_id);

        $shop_order_ids = $ware_return->shop_order_ids;

        $model = new ShopOrderItem();

        $checkUrl = ZUrl::to([
            '/api/shop/orders/return',
            'ware_return_id' => $ware_return_id,
        ]);

        echo ZGetChecksWidget::widget([
            'model' => $model,

            'config' => [
                'url' => $checkUrl,
                'btnOptions' => [
                    'config' => [
                        'icon' => '',
                        'text' => Az::l('Подобрать'),
                        'hasIcon' => false,
                        'isPjax' => false,
                        'btnType' => ZButtonWidget::btnType['link'],
                        'grapes' => false,
                        'btnStyle' => ZButtonWidget::btnStyle['btn-outline-dark'],
                        'title' => Az::l('Подборка'),
                        'message' => Az::l('Вы хотите подобрать эти элементы?'),
                    ]
                ],
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

            <?php
            /** @var ZView $this */

            $model = new ShopOrderItem();

            $model->configs->query = ShopOrderItem::find()
                ->where([
                    'shop_order_id' => $shop_order_ids,
                    'ware_return_id' => null,
                ]);

            $model->configs->readonly = true;
            $model->configs->nameOn = [
                'id',
                'name',
                'shop_catalog_id',
                'ware_id',
                'amount',
                'price_all',
            ];

            $model->columns();

            echo ZDynaWidget::widget([
                'model' => $model,
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
