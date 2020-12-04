<?php

use yii\widgets\Pjax;
use zetsoft\dbitem\core\WebItem;

use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\inputes\ZKRangeWidget;
use zetsoft\widgets\menus\MenuItemWidget;

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

$product_items = Az::$app->market->product->productItemByElements($element_ids, 0, 28);
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




<div id="content" class="container-fluid bg-white">
    <div class="row">
        <div class="col-12 text-center">
            <h2 class="text-muted py-3">Результаты поиска:</h2>
            <hr>

        </div>
    </div>

       <div class="text-center">

        <?php
/*            if(empty($product_items) || $product_items !==null)
                echo  $this->require( '/render/behruz/behruz404circle.php');*/

        if (empty($element_ids)){  ?>
            <div><i class="fas fa-info-circle fa-9x text-light mb-3"></i></div>
            <h4 class="text-muted py-3">Информация, которую вы искали, не найдена.</h4>
      <? } ?>
       </div>

<!--    if (empty($element_ids))
    echo $this->require( '/render/behruz/behruz404circle.php');-->


        <?
        if(!empty($product_items)){
        ?>

                <div class="row">

                    <?
                    foreach ($product_items as $item):
                    ?>
                          <?
                                 echo  $this->require( '/render/cards/ZVMarketWidget/ready/main_row2.php', [
                                 'item'=> $item,
                                 'col' => 3,
                                 'isCommon' => true,
                                 ]);
                         ?>
              
                     <?
                    endforeach;
                    ?>

            </div>
        <?}?>
            </div>


      
<?php $this->endBody() ?>
<?=
$this->require( '/webhtm/block/SingleProduct/footer.php');
?>
</body>
</html>

<?php
$this->endPage()
?>
