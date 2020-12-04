<?php

use kartik\builder\Form;
use zetsoft\dbitem\core\WebItem;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZInfinityScrollAjaxWidget;

use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\inputes\ZKSelect2Widget;
use zetsoft\widgets\navigat\ZBreadcrumbsWidget;

/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Продукты по категориям';
$action->icon = 'fa fa-area-chart';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;
$action->cache = false;
$action->call = null;
$action->cacheHttp = false;

$category_id = $this->httpGet('category_id');
$company_id = $this->httpGet('market_id');


/*$products = Az::$app->market->product->allElements($category_id, $company_id, 1, 10);*/

$this->paramSet(paramAction, $action);
$this->title();
$this->toolbar();
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

<body class="<?= ZWidget::skin['white-skin'] ?> borderzz">

<?php



$this->beginBody();

require Root . '/webhtm/block/header/main.php';
require Root . '/webhtm/block/navbar/main.php';
require Root . '/render/menus/ZSidebarWidget/ready/main.php';

$this->pjaxBegin();







$form = $this->activeBegin();
$model = Az::$app->market->productM->getOptionsByCategory($selectedId = 1084);

echo ZFormWidget::widget([
    'model' => $model,
    'form' => $form,
    'config' => [
        'topBtn' => false,
        'botBtn' => false,
    ],
]);

$this->activeEnd();
?>



<?php
$this->pjaxEnd();
$this->endBody();

echo $this->require( '/webhtm/block/SingleProduct/footer.php');
?>
</body>
</html>
<? $this->endPage() ?>
