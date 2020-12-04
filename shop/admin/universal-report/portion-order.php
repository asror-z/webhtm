<?php

/**
 *
 * @author OtabekNosirov
 * @author JaloliddinovSalohiddin
 * @author AkromovAzizjon
 *
 */

use Afosto\Acme\Data\Order;
use zetsoft\dbitem\core\WebItem;
use zetsoft\former\order\OrderForm;
use zetsoft\former\order\OrderPortionFormForm;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\shop\ShopBrand;
use zetsoft\former\order\OrderPayBackCCForm;
use zetsoft\models\shop\ShopOrder;
use zetsoft\system\Az;

/** @var ZView $this */

/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Проверка порции заказов';
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

    $model = new OrderPortionFormForm();
   
    $model->configs->spa = false;
    $model->configs->nameShowEx=[];
    $model->columns();

    $data = Az::$app->market->orderNurbek->getPortionOrder();

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
            'hasToolbar' => true,
            'editableLink' => true,
            'search' => true,
            'copy' => false,
            'columnBefore' => [
                'false'
            ],
            'isCard' => false,
            'columnAfter' => ['asd'],
            'theme' => 'success',
            'bordered' => false,
            'striped' => false,

        ]
    ]);

    ?>

</div>
<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
