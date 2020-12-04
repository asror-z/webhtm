<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\shop\ShopCatalog;
use zetsoft\models\shop\ShopCategory;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZInfinityScrollAjaxWidget;
use zetsoft\widgets\market\ZCategoryWidget;
use zetsoft\widgets\market\ZFooterAllWidgetOrg;
use zetsoft\widgets\market\ZMenuWidget;
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

$this->paramSet(paramAction, $action);

$category_id = $this->httpGet('id');

$brandId = $this->httpGet('brand_id');


//vdd();

//$brandId=$this->httpGet('id');

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
?>

<div id="content" class="mb-5 mt-3">
    <div class="container-fluid bg-white">
        <?
        if (empty($category_id) && empty($brandId)) :
            echo $this->require( '/render/market/NotFound/main.php',[
                'item'=>'К сожалению, данные отсутствуют.'
            ]);
        else :
            ?>

            <div class="row">
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 media-category">
                    <div class="row">
                        <div class="col-12">
                            <?php

                            echo $this->require( '/render/market/ZFiterWidget/ready/main.php', [
                                'item' => $category_id
                            ]);
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12">
                    <?php

                    echo ZBreadcrumbsWidget::widget([
                        'config' => [
                            'mode' => ZBreadcrumbsWidget::mode['category'],
                            'category_id' => $category_id,

                        ]
                    ]);
                    ?>
                    <div class="switch-parent d-flex justify-content-end mb-2">
                        <a class="btn btn-success rounded mt-0" id="switch_to_col" href="#col">
                            <i class="fas fa-th-large"></i>
                        </a>
                        <a class="btn btn-success rounded mr-2 mt-0" id="switch_to_list" href="#list">
                            <i class="fas fa-th-list"></i>
                        </a>
                    </div>

                    <div class="row d-flex" id="cards-filter">
                        <?php
                        // vdd($this->sessionGet('filter'));
                        //vdd(Az::$app->market->product->allProducts($category_id, null, null, null));
                        $limit = 12;

                        echo ZInfinityScrollAjaxWidget::widget([
                            'config' => [
                                'test' => false,
                                'limit' => $limit,
                                'cols' => 2,
                                'namespace' => 'market',
                                'service' => 'product',
                                'method' => 'allProducts',
                                'args' => $category_id . '|null|0|' . $limit.'|null|'.$brandId,
                            ]
                        ]);

                        ?>
                    </div>
                </div>
            </div>
        <? endif ?>
    </div>
</div>

<div class="mt-4">
    <?= ZFooterAllWidgetOrg::widget() ?>
</div>
<?php
$this->pjaxEnd();
$this->endBody();
//echo $this->require( '/webhtm/block/SingleProduct/footer.php');
?>
</body>
</html>
<? $this->endPage() ?>
