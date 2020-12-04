<?php

/**
 *
 * @author OtabekNosirov
 * @author JaloliddinovSalohiddin
 * @author AkromovAzizjon
 *
 */

use zetsoft\dbitem\core\WebItem;
use zetsoft\former\reports\ReportsOrderStatusForm;
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

$action->title = Azl . 'Статус заказов';
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
        $model = new ReportsOrderStatusForm();

        $model->configs->spa = false;

        $model->configs->nameShowEx = [];
        $model->columns();

        $data = Az::$app->market->reports->getOrderStatus();

        /** @var ZView $this */
        echo ZDynaWidget::widget([
            'data' => $data,
            'model' => $model,
            'type' => ZDynaWidget::type['form'],
            'rightName' => [
                'export'
            ],
            'leftNameEx' => [
                'search'
            ],
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
                'isCard' => false,
                'columnAfter' => false,
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
