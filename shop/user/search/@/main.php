<?php

use yii\widgets\Pjax;
use zetsoft\dbitem\core\WebItem;
use zetsoft\models\shop\ShopOrder;
use zetsoft\models\shop\ShopProduct;
use zetsoft\models\user\User;
use zetsoft\service\forms\Active;
use zetsoft\service\forms\Ajaxer;
use zetsoft\service\forms\ZPjax;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZInfinityScrollAjaxWidget;
use zetsoft\widgets\former\ZExpandableSearchWidgetJ;
use zetsoft\widgets\former\ZExpandableSearchWidgetJXolmat;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\former\ZListViewWidget;
use zetsoft\widgets\inputes\ZKRangeWidget;
use zetsoft\widgets\menus\MenuItemWidget;
use zetsoft\widgets\menus\ZMetisMenuWidget;
use zetsoft\widgets\market\ZMenuWidget;
use zetsoft\widgets\menus\ZSidebarWidget;
use zetsoft\widgets\navigat\ZBreadcrumbsWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\navigat\ZMarketDropdownWidget;
use zetsoft\widgets\navigat\ZReadMoreWidget;

use function Matrix\divideby;

/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Продукты по категориям';
$action->icon = 'fa fa-area-chart';
$action->type = WebItem::type['html'];

                                              

$search = $this->httpGet('search');

Az::$app->search->tntSearchService->model = "zetsoft\\models\\shop\\ShopElement";

Az::$app->search->tntSearchService->name = "ShopElement";

Az::$app->search->tntSearchService->search = $search;

$element_ids = Az::$app->search->tntSearchService->regularSearch();

$product_items = Az::$app->market->product->productItemByElements($element_ids, 0, 20);

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
<body class="<?= ZWidget::skin['white-skin'] ?> borderzz">
<?php

$this->beginBody();                                 

require Root . '/webhtm/block/header/main.php';
require Root . '/webhtm/block/navbar/main.php';
require Root . '/render/menus/ZSidebarWidget/ready/main.php';
?>




<div class="container-fluid bg-white">

       <div>
        <?php
                
            if(empty($element_ids))
                echo  $this->require( '/render/behruz/behruz404circle.php');
        ?>
       </div>

            <div class="row">
                    <?
                    foreach ($product_items as $item):
                    ?>
                <div class="col-3 mb-1">
                    <? 
                     echo  $this->require( '/render/cards/ZVMarketWidget/ready/main.php', [
                     'item'=> $item,
                     'col' => 12,
                     'isCommon' => true,

                     ]);
                     ?>
                </div>
                     <?
                    endforeach;
                    ?>

            </div>

</div>
                    <?php



?>
<?php $this->endBody() ?>
<?=
$this->require( '/webhtm/block/SingleProduct/footer.php');
?>
</body>
</html>

<?php
$this->endPage()
?>
