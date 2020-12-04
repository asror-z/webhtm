<?php

/**
 *
 * @author OtabekNosirov
 * @author JaloliddinovSalohiddin
 * @author AkromovAzizjon
 *
 **/


use zetsoft\dbitem\core\WebItem;
use zetsoft\former\reports\ReportsDailyFormSkd;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;

/** @var ZView $this */

/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Ежедневный отчёт';
$action->icon = 'fal fa-calendar-times-o';
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

    <div id="content">
        <?php
        $date = Az::$app->cores->date->date();
        $model = new ReportsDailyFormSkd();

        /*$element = new ShopElement();
        $product = new ShopProduct();
        $orderItem = new ShopOrderItem();
        $order = new ShopOrder();
        $order->query = ShopOrder::find()->where([
            'date_deliver' => $date,
            'status_logistics' => [
                ShopOrder::status_logistics['shipment_ready'],
                ShopOrder::status_logistics['completed'],
            ],
        ]);

        $model->date = $date;
        $model->name = $element->name;
        $model->best_before = $product->best_before;*/
       /* $model->initial_balance = (int)$order->amount * (int)$orderItem->price_all;
        $model->coming = (int)$order->amount * (int)$orderItem->price;
        $model->final_balance = (int)$model->best_before + $model->initial_balance + $model->coming;*/


        echo ZDynaWidget::widget([
            'model' => $model,
            'data' => Az::$app->market->reports2->dailyReport(),
            'type' => ZDynaWidget::type['form'],
            'config' => [
               'type' => 'form',
                'hasToolbar' => true,
                'columnBefore' => [
                    'serial',
                    'action',
                    'checkbox',
                    'id'
                ],
                'actionButtons' => [
                    'clone',
                    'delete',
                    'view'
                ],
                'spaHeight' => [
                    'create' => '800px',
                    'view' => '800px',
                ],
                'columnAfter' => false,
                'createTitle' => Az::l('Создание прихода в склад')
            ]
        ]);

        ?>

    </div>
    <?php require Root . '\webhtm\block\footer\footerAdmin.php' ?>
</div>
<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
