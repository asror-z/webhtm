<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\cpas\CpasOffer;
use zetsoft\models\cpas\CpasOfferItem;
use zetsoft\models\cpas\CpasLand;
use zetsoft\models\shop\ShopOrder;
use zetsoft\models\test\TestDilshod;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZDynaWidgetD;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\former\ZListViewWidget;
use zetsoft\widgets\inputes\ZSelect2Widget;
use zetsoft\widgets\navigat\ZBreadcrumbsWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;use zetsoft\widgets\themes\ZCardWidget;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Создание Бренды';
$action->icon = 'fa fa-globe';
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

/*require Root . '/webhtm/block/header/main.php';*/
require Root . '/webhtm/block/header/main.php';

echo ZNProgressWidget::widget([]);

echo ZNProgressWidget::widget([]);


?>

<div id="page">

    <?

    echo ZSessionGrowlWidget::widget();

    $model = new ShopOrder();



    $model->configs->showForm = [
        'name' => false,
        'user_company_ids' => false,
    ];

    $model->columns();

    echo ZFormBuildWidget::widget([
        'model' => $model
    ])
   ?>
</div>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
