<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\shop\ShopOrder;
use zetsoft\models\shop\ShopStatus;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\menus\ZMmenuWidgetSh;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\shop\ShopBrand;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Бренды';
$action->icon = 'fa fa-globe';
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

    require Root . '/webhtm/block/navbar/mainJavohir.php';
    require Root . '/webhtm/block/menu/menu-m-j.php';

    echo ZSessionGrowlWidget::widget();?>
    <nav id="menu"></nav>
    <div id="page">
    <div id="content" class="content-footer p-3">


        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="card col-2">
                        <div class="card-body">
                            <div class="card-text">
                                <ul>
                                    <li>Все заказы: <?= Az::$app->market->companyStat->orderCountAll() ?></li>
                                    <?php

                                    foreach (ShopStatus::find()->all() as $key => $status):
                                        ?>
                                        <li><?= $status->name ?>
                                            : <?= Az::$app->market->companyStat->orderByStatusAndCompany($status->id) ?></li>
                                    <?php endforeach; ?>

                                </ul>
                            </div>
                        </div>

                    </div>
                    <div class="card col-2">
                        <div class="card-body">


                            <div class="card-text">
                                <ul>
                                    <li>Всего товаров штук:</li>
                                    <li>Всего товаров кг:</li>
                                    <li>Всего товаров метр:</li>
                                    <li>Всего товаров литр:</li>
                                    <li>Заказов сегодня:</li>
                                </ul>
                            </div>


                        </div>

                    </div>
                </div>
            </div>
        </div>


        
    </div>

</div>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
