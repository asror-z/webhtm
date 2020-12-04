<?php

use zetsoft\dbitem\shop\MultiProductItem;
use zetsoft\dbitem\shop\ProductItem;
use zetsoft\dbitem\shop\PropertyItem;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\dbitem\core\WebItem;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;

/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Описание';
$action->icon = 'fa fa-area-chart';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;

$action->cache = false;
$action->cacheHttp = false;

$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

$product_id = $this->httpGet('id');
$get = $this->httpGet();
$productId = ZArrayHelper::getValue($get, 'product_id');
unset($get['id']);


/** @var ProductItem[] $product */

$product = Az::$app->market->product->product($product_id, null, true);

if (empty($product)) {
    echo $this->require( '/webhtm/shop/user/product-single/empty/emptyy.php');
    return null;
}

Az::$app->market->wish->writeViewed($product_id);

/** @var ZView $this */
$this->beginPage();
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <?php
    require Root . '/webhtm/block/metas/main.php';
    require Root . '/webhtm/block/assets/main.php';
    $this->fileCss('/render/asrorz/css/loader.css');

    $this->head();
    ?>
</head>
<body class="<?= ZWidget::skin['white-skin'] ?>">
<?php
$this->beginBody();
require Root . '/webhtm/block/header/main.php';
require Root . '/webhtm/block/navbar/main.php';

?>

<div class="container-fluid mt-3">

    <?
    if (empty($product_id)) {
        echo $this->require( '/render/market/NotFound/main.php', [
            'item' => 'not product id'
        ]);
    } elseif (empty($product)) {
        echo $this->require( '/webhtm/shop/user/product-single/empty/empty.php', [
            'item' => 'not product'
        ]);
    } else {
        echo $this->require( '/render/market/ZYandexSingleProductHeaderWidget/ready/single-product-header.php', [
            'product_id' => $product_id ?? ''
        ]);
        echo $this->require( '/webhtm/shop/user/product-element/block/yandexTab.php', [
            'id' => $product_id,
            'type' => 'product'
        ]);
        ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card-title">
                    <!-- --><? /* $this->pjaxBegin(); */ ?>
                    <?
                        echo $this->require( '/webhtm/shop/user/product-element/block/tab_product.php', [
                        // 'productProperty' => $productProperty,
                        'product' => $product,
                        ]);
                    ?>
                </div>
            </div>
        </div>
        <hr>
        <?
    } ?>

</div>


<?php
echo $this->require( '/webhtm/block/SingleProduct/footer.php');
?>

<? /*

echo $this->require( '/webhtm/shop/user/product/block/suggestions.php');

*/ ?>


<script>
    window.onload = () => {
        let temp = "<div class='text-danger text-center' id='market-alert'>Для начала необходимо выбрать свойства продукта</div>";
        $('#market_list').append(temp);
        console.log(temp);
    };

    var radioBtns = $(document).find('input[type="radio"]');
    radioBtns.each(function (key, radio) {
        $(radio).click(function () {
            loadData();
            $('#refreshMarketList').click();
        })
    });
</script>

<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
