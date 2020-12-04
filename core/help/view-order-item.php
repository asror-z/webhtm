<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\shop\ShopOrderItem;
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
                $shop_order_id = $this->httpGet('shop_order_ids');
                         vdd($this->httpGet());
                $order = ShopOrder::findOne(['id' => $shop_order_id]);
                
                if ($order === null) {
                    return $this->alertDanger( '', Az::l("Товар по $shop_order_id не найден"));
                }
                
                $model = new ShopOrderItem();

                $model->configs->query = ShopOrderItem::find()
                    ->where([
                        'shop_order_id' => $shop_order_id
                    ]);

                $model->configs->nameOn = [
                    'id',
                    'shop_catalog_id',
                    'user_company_id',
                    'ware_id',
                    'amount',
                    'price',
                    'price_all',
                    'best_before',
                ];

                $model->configs->width = [
                    'shop_catalog_id' => '200px',
                    'user_company_id' => '170px',
                    'ware_id' => '170px',
                    'amount' => '100px',
                    'price' => '100px',
                    'price_all' => '100px',
                    'best_before' => '130px',
                ];

                $model->configs->title = Az::l('Товары Заказа ') . $order->number;
                
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
                        ],
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
