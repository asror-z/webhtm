<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\shop\ShopOrderItem;
use zetsoft\models\shop\ShopShipment;
use zetsoft\system\Az;
use zetsoft\system\except\ZException;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaDialogWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZViewWidget;
use zetsoft\widgets\inputes\ZHRadioButtonGroupWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\shop\ShopOrder;
use function Dash\Curry\find;


/** @var ZView $this */


/**
 *
 * Action Params
 * @author MurodovMirbosit
 */

$action = new WebItem();

$action->title = Azl . 'Просмотр Заказы';
$action->icon = 'fal fa-lock';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = false;
$action->cache = false;
$action->call = null;
$action->cacheHttp = false;

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
    <div id="content" class="content-footer p-3">


        <div class="row">
            <div class="col-md-12 col-12">
                <?
                $shop_shipment_id = $this->httpGet('shop_shipment_id');

                $shop_shipment = ShopShipment::findOne($shop_shipment_id);
                if ($shop_shipment === null) {
                    throw new ZException(Az::l('Товар не найден.'));
                }

                $model = new ShopOrder();

                $model->configs->query = ShopOrder::find()
                    ->where([
                        'shop_shipment_id' => $shop_shipment_id,
                    ]);

                $model->configs->nameOn = [
                    'number',
                    'code',
                    'contact_name',
                    'contact_phone',
                    'place_region_id',
                    'children',
                    'user_company_ids',
                    'ware_ids',
                    'total_price',
                ];


                $model->configs->title = Az::l('Заказы доставки №') . $shop_shipment->id;

                $model->configs->readonly = true;

                $model->columns();

                echo ZDynaWidget::widget([
                    'model' => $model,
                    'leftBtn' => [
                        'status' => [
                            'content' => '',
                            'options' => ['class' => 'mx-3']
                        ],
                        'search' => [
                            'content' => '',
                            'options' => ['class' => ' p-1 mr-0 {btnSize} {iconSize}']
                        ],
                    ],
                    'config' => [
                        'columnBefore' => [
                            'checkbox',
                            'id',
                            'serial'
                        ],
                        'hasItems' => false,
                        'actionButtons' => false,
                        'columnAfter' => false,
                    ],
                    'rightBtn' => [
                        'system' => [
                            'content' => '',
                            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                        ],

                        'update' => [
                            'content' => '',
                            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                        ],

                        'add-clone-delete' => [
                            'content' => '',
                            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                        ],

                        'filter-sort-id' => [
                            'content' => '',
                            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                        ],

                        'statistics' => [
                            'content' => '',
                            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                        ],

                        'export' => [
                            'content' => '',
                            'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
                        ],
                        'toggleData' => [
                            'content' => '',
                            'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
                        ],
                    ],
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
