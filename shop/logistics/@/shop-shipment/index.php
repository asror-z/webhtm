<?php

use kartik\grid\DataColumn;
use zetsoft\dbitem\core\WebItem;
use zetsoft\system\Az;
use zetsoft\system\column\ZKDataColumn;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\inputes\ZInputWidget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\menus\ZMmenuWidgetSh;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\shop\ShopShipment;


/** @var ZView $this */


/**
 *
 * Action Params
 * @author MurodovMirbosit
 */

$action = new WebItem();

$action->title = Azl . 'Назначение заказов курьеру';
$action->icon = 'fal fa-area-chart';
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

    require Root . '/webhtm/block/header/main.php';
    require Root . '/webhtm/block/navbar/admin.php';

    echo ZSessionGrowlWidget::widget();?>

    <div id="content" class="content-footer p-3" style="overflow-x: hidden !important;">


        <div class="row">
            <div class="col-md-12 col-12">

                <?
              

                $model = new ShopShipment();
                $model->configs->spa = false;
                $model->configs->nameOn = [
                    'id',
                    //'created_at',
                    'code',
                    'shop_courier_id',
                    'date_deliver',
                    'responsible',
                ];

                $model->columns();

                /** @var ZView $this */
                echo ZDynaWidget::widget([
                    'model' => $model,
                    'config' => [
                        'updateUrl' => '{fullUrl}/process.aspx?shop_shipment_id={id}',
                        'spaArray' => [
                            'create' => true,
                            'update' => false
                        ],
                        'spaHeight' => [
                            'create' => '500px',
                            'view' => '750px'
                        ],
                        'actionButtons' => [
                            'update',
                            'delete',
                            'clone',
                            'view',
                        ],
                        
                        'columnBefore' => [
                            'serial',
                            'checkbox',
                            'action',
                        ],
                        'columnAfter' => false
                    ],
                    'rightBtn' => [
                        'update' => [
                            'content' => '{update}',
                            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                        ],
                        'system' => [
                            'content' => '{system}',
                            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                        ],
                    ],
                ]);

                ?>

            </div>
        </div>


    </div>
    <? require Root . '\webhtm\block\footer\footerAdmin.php' ?>
</div>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
