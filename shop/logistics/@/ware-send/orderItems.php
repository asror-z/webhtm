<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\shop\ShopOrder;
use zetsoft\models\shop\ShopOrderItem;
use zetsoft\models\ware\WareAccept;
use zetsoft\models\ware\WareEnterItem;
use zetsoft\models\ware\WareExit;
use zetsoft\models\ware\WareExitItem;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\inputes\ZHHiddenInputWidget;
use zetsoft\widgets\navigat\ZSmartTabWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\models\ware\WareEnter;


/** @var ZView $this */


/**
 *
 * Action Params
 * @author MurodovMirbosit
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

<style>
    .iframe-orders {
        border: none;
        min-height: 600px;
    }
</style>

<div id="page">

    <?
    echo ZSessionGrowlWidget::widget();?>

    <div id="content" class="content-footer p-3">


        <div class="row">
            <div class="col-md-12">

                <?

                $shop_shipment_id = $this->httpGet('shop_shipment_id');
                
                $shop_order = ShopOrder::find()
                    ->where([
                        'shop_shipment_id' => $shop_shipment_id
                    ])
                    ->asArray()
                    ->all();

                $shop_order_ids = ZArrayHelper::getColumn($shop_order, 'id');

                $model = new ShopOrderItem();
                $model->configs->query = ShopOrderItem::find()
                    ->where([
                        'shop_order_id' => $shop_order_ids
                    ]);

                $model->columns();

                /** @var ZView $this */
                echo ZDynaWidget::widget([
                    'model' => $model,
                    'rightBtn' => [
                        'add-tabular-clone-delete' => [
                            'content' => "{add}{tabular}",
                            'options' => ['class' => 'btn-group p-1 mr-2 {btnSize} {iconSize}']
                        ],
                    ],
                    'config' => [
                        'isCard' => false,
                        'spaHeight' => [],
                        'spa' => true,
                        'hasToolbar' => true,
                        'createUrlAjax' => ZUrl::to([
                            'create-process',
                            'id' => $this->httpGet('order_id'),
                        ]),
                        'createUrl' => 'create-item',
                        'columnBefore' => [
                            'serial',
                            'radio',
                        ],
                        'actionButtons' => [
                        ],
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

