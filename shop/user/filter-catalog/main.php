<?php

use PhpOffice\PhpSpreadsheet\Shared\OLE\PPS\Root;
use zetsoft\dbitem\core\WebItem;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZInfinityScrollAjaxWidget;

use zetsoft\widgets\market\ZFooterAllWidgetOrg;
use zetsoft\widgets\menus\ZMenuItemWidget;
use zetsoft\widgets\navigat\ZBreadcrumbsWidget;
use zetsoft\widgets\navigat\ZReadMoreWidget;

/** @var ZView $this */


/**
 *
 * @license JaloliddinovSalohiddin
 * @license OtabekNosirov
 * @license AkromovAzizjon
 */

$action = new WebItem();

$action->title = Azl . 'Продукты по категориям';
$action->icon = 'fa fa-area-chart';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->apps = [
    'market',
    'marketplace',
    'mplace',
];
$action->debug = true;
$action->cache = false;
$action->call = null;
$action->cacheHttp = false;

$category_id = $this->httpGet('category_id');
$company_id = $this->httpGet('market_id');
if ($company_id === null || $category_id === null) {
    echo Az::l('Похоже, вы зашли на эту страницу по неправильной ссылке. Пожалуйста, попробуйте позже.');
    return null;
}

$item = Az::$app->market->category->getMenuItem($category_id, true);
 
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

require Root . '/webhtm/block/header/mainM.php';
require Root . '/webhtm/block/navbar/main.php';
require Root . '/render/menus/ZSidebarWidget/ready/main.php';

$this->pjaxBegin();
?>

<div id="content" class="mb-5 mt-3">
    <div class="container-fluid bg-white">
        <?
        if (empty($category_id) || empty($company_id))
            echo $this->require( '/render/market/NotFound/main.php', [
                'item' => 'not category id or market id'
            ]);
        else {
            ?>
            <div class="row">

                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 media-category">
                    <div class="row">
                        <div class="col-12">
                            <div class="border border-light rounded mb-3">
                                <h5 class="py-2 pl-4 bg-light">
                                    <?= Az::l('Смежные категории') ?>
                                </h5>
                                <?php
                                /** @var ZView $this */
                                if (empty($item)) {
                                    echo $this->require( '/webhtm/shop/user/filter-catalog/empty/empty.php');
                                } else {
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
                                }
                                ?>
                            </div>
                            <?php

                            echo $this->require( '/render/market/ZFiterWidget/ready/main.php', [
                                'item' => $category_id,
                                'market_id' => $company_id
                            ]);
                            
                            ?>
                        </div>
                    </div>
                </div>

                <div class="col-lg-9 col-md-9 col-sm-12 ">
                    <div class="switch-parent d-flex mb-2">
                        <?php
                        echo ZBreadcrumbsWidget::widget([
                            'config' => [
                                'mode' => ZBreadcrumbsWidget::mode['category'],
                                'category_id' => $category_id,
                                'bg-class' => 'mb-0 mt-1',
                            ]
                        ]);
                        ?>
                        <a class="btn btn-success rounded" id="switch_to_col" href="#col">
                            <i class="fas fa-th-large"></i>
                        </a>
                        <a class="btn btn-success rounded" id="switch_to_list" href="#list">
                            <i class="fas fa-th-list"></i>
                        </a>
                    </div>

                    <div class="row d-flex mb-2" id="cards-filter">
                        
                        <?
                        $market_id = $this->httpGet('market_id');
                        
                        echo ZInfinityScrollAjaxWidget::widget([
                            'config' => [
                                'test' => false,
                                'cols' => 4,
                                'namespace' => 'market',
                                'service' => 'product',
                                'method' => 'allElements',
                                'args' => $category_id . '|'.$market_id.'|1|10|[]',
                            ]
                        ]);

                        ?>
                    </div>
                </div>
            </div>
        <? } ?>
    </div>
</div>

<div class="mt-4">
    <?= ZFooterAllWidgetOrg::widget(); ?>
</div>
<script>
    
    function addToCart(element) {
        
        var catalogId = element.attr('data-catalog-id');
        element.addClass('d-none');
        var parent = element.parent('.footer-main');
        var childTouch = parent.children(".touch-main");
        var second = childTouch.children('.touch-main-children').children('.parent-clear').children('.bootstrap-touchspin').children('.clear-add-btn');
        childTouch.removeClass("d-none");
        second.val(1);

        $.ajax({
            url: '/core/product/setToCart.aspx',
            method: 'GET',
            data: {
                catalog_id: catalogId,
                amount: 1,
            },
            success: function (data) {
                $('#cart_total_amount').html(data);
                $('#refreshMessage').click();
            },
            error: function (error) {
                console.log(error);
            }
        })

    }

    function deleteFromCart(element) {
        var clear = $(element).parents(".touch-main:first");
        let add_cart = clear.prev('.add-card');
        var zero = $(element).prev('.parent-clear');
        var first = zero.children(".bootstrap-touchspin");
        var second = first.children(".clear-add-btn");
        $(add_cart).removeClass("d-none");
        $(clear).addClass("d-none");
        second.val(0);
        var catalogId = $(element).attr('data-catalog-id');
        console.log(catalogId);
        $.ajax({
            url: '/core/product/setToCart.aspx',
            method: 'GET',
            data: {
                catalog_id: catalogId,
                amount:0,
            },
            beforeSend: function () {
                //$('#refreshMessage').click();
            },
            success: function (data) {
                $('#cart_total_amount').html(data);
                console.log(data, $('#cart_total_amount').html(data))
                $('#refreshMessage').click();
            },
            error: function (error) {
                console.log(error);
            }
        })
    }



    function spinUp(amount,catalogId)
    {
        $.ajax({
            url: '/core/product/setToCart.aspx',
            method: 'GET',
            data: {
                catalog_id: catalogId,
                amount: amount,
            },
            success: function (data) {
                $('#cart_total_amount').html(data);
            },
            error: function (error) {
                console.log(error);
            }
        })
    }

    function spinDown(amount,catalogId) {


        $.ajax({
            url: '/core/product/setToCart.aspx',
            method: 'GET',
            data: {
                catalog_id: catalogId,
                amount: amount --,
            },
            success: function (data) {
                $('#cart_total_amount').html(data);
            },
            error: function (error) {
                console.log(error);
            }
        })

    }


</script>
<?php
$this->pjaxEnd();
$this->endBody();

//echo $this->require( '/webhtm/block/SingleProduct/footer.php');
?>
</body>
</html>
<? $this->endPage() ?>
