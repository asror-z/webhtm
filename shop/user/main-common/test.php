<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\shop\ProductItem;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\market\ZFooterAllWidget;
use zetsoft\widgets\market\ZFooterAllWidgetOrg;
use zetsoft\widgets\navigat\ZBreadcrumbsWidget;
use zetsoft\widgets\navigat\ZReadMoreWidget;
use zetsoft\widgets\notifier\ZJspanelWidget;
use zetsoft\widgets\animo\ZFakeLoaderNewWidget;

/**
 *
 * @license JaloliddinovSalohiddin
 * @license OtabekNosirov
 * @license AkromovAzizjon
 */

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




/*

vd($this->urlMain);
vd($this->urlParam);
vd($this->urlArray);
vd($this->urlModule);
vd($this->urlModuleStr);
vd($this->urlParamStr);

$this->urlRedirect([
    'index',
    'sort' => '-id'
]);
*/





//vdd(Az::$app->language);

//shop/user/session-basket/main

$this->title();
$this->toolbar();

/** @var ZView $this */
$this->beginPage();
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <?php

 /*   require Root . '/webhtm/block/metas/main.php';
    require Root . '/webhtm/block/assets/main.php';*/

    $this->head();

    ?>
</head>
<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php

$this->beginBody();
require Root . '/webhtm/block/header/main.php';
require Root . '/webhtm/block/navbar/main.php';

?>



<?php
?>
<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
