<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\shop\ShopOrderItem;
use zetsoft\models\shop\ShopOrder;
use zetsoft\models\ware\WareReturn;
use zetsoft\service\forms\Active;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZCheckDependWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZExportBtnWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\inputes\ZInputWidget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;

/** @var ZView $this */


/**
 *
 * Action Params
 * @author MurodovMirbosit
 */

$action = new WebItem();

$action->title = Azl . 'Возврат товаров от клиентов';


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

    echo ZSessionGrowlWidget::widget();


    ?>

    <div id="content" class="content-footer p-3">


        <div class="row">

            <div class="col-md-12 mx-auto mt-5">

                <?
                $ware_return_id = $this->httpGet('ware_return_id');
                $ware_return = WareReturn::findOne($ware_return_id);

                $model = new ShopOrderItem();

                $model->configs->query = ShopOrderItem::find()
                    ->where([
                        'ware_return_id' => $ware_return_id
                    ]);
                $model->configs->nameOn = [
                    'id',
                    'name',
                    'shop_catalog_id',
                    'ware_id',
                    'amount',
                    'amount_partial',
                    'amount_return',
                    'price',
                    'price_all',
                    'price_all_partial',
                    'price_all_return',
                ];

                $model->configs->readonly = [
                    'id',
                    'name',
                    'shop_order_id',
                    'ware_id',
                    'amount',
                    'amount_return',
                    'price',
                    'price_all',
                    'price_all_partial',
                    'price_all_return',
                ];
                $model->columns();

                echo ZDynaWidget::widget([
                    'model' => $model,
                    'config' => [
                        'deleteAllUrl' => ZUrl::to([
                            '/api/shop/orders/deleteReturn',
                            'ware_return_id' => $ware_return_id,
                        ]),
                        'spaArray' => [
                            'view' => false,
                            'update' => false,
                        ],
                        'hasToolbar' => true,
                        'spa' => true,
                        'search' => false,
                        'headerIcon' => '',
                        'columnBefore' => [
                            'checkbox',
                            'serial',
                            'id'
                        ],
                        'spaWidth' => [
                            'choose' => '1000px'
                        ],
                        'columnAfter' => false,

                    ],

                    'rightBtn' => [
                        'update' => [
                            'content' => '',
                            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                        ],

                        'system' => [
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
