<?php


use PhpOffice\PhpSpreadsheet\Shared\OLE\PPS\Root;
use zetsoft\dbitem\core\WebItem;
use zetsoft\models\shop\ShopCatalog;
use zetsoft\models\user\UserCompany;
use zetsoft\models\shop\ShopElement;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\inputes\ZKStarRatingWidget;
use zetsoft\widgets\market\ZFooterAllWidget;
use zetsoft\widgets\notifier\ZJspanelWidget;

$model = UserCompany::find();
$productId= $this->httpGet('id');



/* vdd($copmany);*/
/** @var ShopCatalog $item */

/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Главная страница';
$action->icon = 'fa fa-area-chart';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;

$action->cache = false;

$action->call = [];

$action->cacheHttp = false;

$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

/** @var ZView $this */
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
require Root . '/webhtm/block/header/main.php';
require Root . '/render/menus/ZSidebarWidget/ready/main.php';
require Root . '/webhtm/block/navbar/main.php';

?>
<div class="container">

    <div class="row">
<?

$copmanies = Az::$app->market->product->allCompanies();
    foreach ($copmanies as $copmany) {
 
        echo $this->require( '/render/cards/ZHPriceCardWidget/demo/clean.php',[
          'company'=>$copmany
        ]);
    }
?>
    </div>
</div>





<?php
echo ZFooterAllWidget::widget();
echo ZJspanelWidget::widget([]);
?>
<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
