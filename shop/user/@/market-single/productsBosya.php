<?php

use yii\widgets\Pjax;
use zetsoft\dbitem\chat\ReviewItem;
use zetsoft\dbitem\core\WebItem;
use zetsoft\service\forms\Ajaxer;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZInfinityScrollAjaxWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\former\ZListViewWidget;
use zetsoft\widgets\inputes\ZKRangeWidget;
use zetsoft\widgets\menus\MenuItemWidget;
use zetsoft\widgets\menus\ZMenuItemWidget;
use zetsoft\widgets\menus\ZMetisMenuWidget;
use zetsoft\widgets\market\ZMenuWidget;
use zetsoft\widgets\menus\ZSidebarWidget;
use zetsoft\widgets\navigat\ZBreadcrumbsWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\navigat\ZGAccordionWidget;
use zetsoft\widgets\navigat\ZMarketDropdownWidget;
use zetsoft\widgets\navigat\ZReadMoreWidget;
/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Kompaniya';
$action->icon = 'fa fa-area-chart';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;
$action->cache = false;
$action->call = null;
$action->cacheHttp = false;

$this->paramSet(paramAction, $action);

$this->title();

$this->toolbar();

/** @var ZView $this */
$category_id = $this->httpGet('category_id');
$company_id = $this->httpGet('market_id');
if (!isset($company_id))
    $company_id = 1;
$item = Az::$app->market->category->generateDBMenuItems($company_id);
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
echo $this->require( '/render/market/ZYandexSingleProductHeaderWidget/ready/single-company-header.php');

// commentni ochmela Yandex_tabga ulangan
//require Root . '/render/menus/ZSidebarWidget/ready/main.php';
?>
<div class="container-fluid bg-white">
    <?php
    echo $this->require( '/webhtm/shop/user/market-single/block/yandexTab.php',)
    ?>
    <div class="row py-3">
        <div class="col-3">
            <div class="row mx-1">
                <div class="col-12">
                    <?/*= $this->require( '/webhtm/shop/user/common/main.php') */?>
                </div>
                <div class="col-12">
                    <div class="border border-light rounded mb-3">
                        <h5 class="py-2 pl-4 bg-light">
                            <?= Az::l('Смежные категории') ?>
                        </h5>
                        <?php
                        /** @var ZView $this */

                        echo ZMenuItemWidget::widget([
                            'config' => [
                                'menuItem' => $item,

                            ]
                        ]);
                        echo ZReadMoreWidget::widget([
                            'config' => [
                                'parentclass' => 'menu-container',
                                'itemInSummary' => 10,
                                'itemClass' => 'mode',
                            ]
                        ]);
                        ?>
                    </div>
                    <?
                    echo $this->require( '/render/market/ZFiterWidget/ready/mainM.php', [
                        'item' => $category_id,
                    ]);
                    ?>
                </div>
            </div>
            <?

            echo ZButtonWidget::widget([
                'id' => 'sendValues',
                'config' => [
                    'text' => 'send form',
                    'btnType' => ZButtonWidget::btnType['button'],
                ]
            ]);
            ?>
        </div>
        <div class="col-9">
            <div class="row">
                <div class="col-12">
                    <?php
                    echo ZBreadcrumbsWidget::widget([
                        'config' => [
                            'mode' => ZBreadcrumbsWidget::mode['category'],
                            'category_id' => 1234
                        ]
                    ]);
                    ?>
                </div>
                <?php
?>
                <div class="col-md-12 pl-0">

                    <?php
                    /** @var ZView $this */
                    echo $this->require( '/render/cards/ZListViewWidget/ready/tab_product.php');
                    ?>

                </div>

                <div class="col-12">
                    <?php
                    Pjax::begin();
                    ?>
                    <div id="contento" class="row w-100">

                        <?

                        $page = 1;
                        $limit = 10;
                        $items = Az::$app->market->product->allProducts($category_id, $company_id, $page, $limit, $sort = []);
                        foreach ($items as $item)
                        {
                            echo $this->require( '/render/cards/ZVMarketWidget/ready/main_row.php',
                                [
                                    'item' => $item
                                ]);
                        }

                        echo ZInfinityScrollAjaxWidget::widget([
                            'config' => [
                                'url' => 'infinity.aspx',
                                'requireUrl' => '/render/cards/ZListViewWidget/ready/vertical_horizontal_infinity.php',
                                'limit' => 6,
                                'cols' => 2,
                                'test' => false
                            ]
                        ]);


                        ?>


                    </div>
                    <?php Pjax::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<style>

    #sendValues {
        visibility: hidden;
    }

</style>


<?php echo ZReadMoreWidget::widget([
    'config' => [
        'parentclass' => 'parrentbody',
        'itemInSummary' => 3,
        'itemClass' => 'es-selectable',
    ]
]);

echo ZReadMoreWidget::widget([

    'config' => [

        'itemInSummary' => 2,
        'parentclass' => 'accPanelBody',
        'itemClass' => 'optionCheckBoxes',
    ]
]);
echo ZReadMoreWidget::widget([

    'config' => [

        'itemInSummary' => 8,
        'parentclass' => 'menu-container',
        'itemClass' => 'mode',
    ]
]);
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
