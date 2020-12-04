<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\place\PlaceAdress;
use zetsoft\models\place\PlaceCountry;
use zetsoft\models\place\PlaceRegion;
use zetsoft\models\shop\ShopOrder;
use zetsoft\models\shop\ShopOrderCopy;
use zetsoft\models\shop\ShopOrderItem;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZCheckSelectWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\inputes\ZHInputWidget;
use zetsoft\widgets\inputes\ZSelect2Widget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\ware\WareAccept;


/** @var ZView $this */


/**
 *
 * Action Params
 * @author MurodovMirbosit
 */

$action = new WebItem();

$action->title = Azl . 'Приёмка от курьера';
$action->icon = 'fal fa-cube';
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

<div class="mx-auto col-8">
    <?php

    $form = $this->activeBegin();

    $model =new ShopOrderCopy();
    $model->configs->nameOn = [
        'shop_order_id',
        'items'
    ];
    $model->columns();


    echo ZFormBuildWidget::widget([
        'form' => $form,
        'model' => $model
    ]);

    $this->activeEnd();


    ?>
</div>

<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
