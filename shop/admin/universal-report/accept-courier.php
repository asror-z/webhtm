<?php

/**
 *
 * @author OtabekNosirov
 * @author JaloliddinovSalohiddin
 * @author AkromovAzizjon
 *
 **/


use zetsoft\dbitem\core\WebItem;
use zetsoft\former\order\OrderForm;
use zetsoft\models\shop\ShopOrder;
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

$action->title = Azl . 'Приёмка от курьера';
$action->icon = 'fal fa-calendar-times-o';
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
/*require Root . '/webhtm/block/navbar/mainAdmin.php';
require Root . '/webhtm/block/menu/menu-m.php';*/
echo ZNProgressWidget::widget([]);
?>

<div id="page">
    <nav id="menu"></nav>

    <?

    echo ZSessionGrowlWidget::widget();?>

    <div id="content">
        <?
        $model = new OrderForm();

        $model->configs->spa = false;

        $model->columns();

        //$data = Az::$app->market->reports->getAcceptanceFromCourier();
        
        $data = Az::$app->market->reportsXolmat->getAcceptanceFromCouries('2019-02-20', '2020-12-20', ShopOrder::status_accept['completed']);

        

        /** @var ZView $this */
        echo ZDynaWidget::widget([
            'data' => $data,
            'model' => $model,
            'rightName' => [
                'export'
            ],
            'leftNameEx' => [
                'search'
            ],
            'type' => ZDynaWidget::type['form'],
            'config' => [
                'type' => 'form',
                'title' => Azl.('Приёмка от курьера'),
                'hasToolbar' => true,
                'editableLink' => true,
                'search' => true,
                'copy' => false,
                'columnBefore' => [
                    'false'
                ],
               // 'isCard' => true,
                'columnAfter' => ['asd'],
                'theme' => 'success',
                'bordered' => false,
                'striped' => false,
            ]
        ]);

        ?>

    </div>
    <? require Root . '\webhtm\block\footer\footerAdmin.php' ?>
</div>
<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
