<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

use FontLib\Table\Type\name;
use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\shop\CompanyCardItem;
use zetsoft\dbitem\shop\ProductItem;
use zetsoft\dbitem\shop\PropertyItem;
use zetsoft\former\shop\ShopCompanyCardForm;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\cards\ZHMarketSuggestion;
use zetsoft\widgets\navigat\ZYandexTabWidget;

/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Цены';
$action->icon = 'fa fa-area-chart';
$action->type = WebItem::type['ajax'];
$action->csrf = true;
$action->debug = true;

$action->cache = false;
$action->cacheHttp = false;

$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

$id = $this->httpGet('id');

$product = Az::$app->market->product->product($id);

if (!isset($product) || $product===null) {

    $item = new ProductItem();
    $item->id = 2;
    $item->name = 'Арахисовая паста с медом 200г';
    $item->title = 'Test Desc';
    $item->new_price = '99 000';
    $item->price_old = '100 000';
    $item->barcode = '34234234';
    $item->exist = ProductItem::exists['not'];
    $item->images =
        'https://images.pexels.com/photos/1095550/pexels-photo-1095550.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500';
    $item->currency = 'сум';
    $item->currencyType = 'after';
    $item->measure = 'шт';
    $item->rating = 3.5;
    $item->discount = -10;
    $item->catalogId = 19;
    $item->max_price = 2155632;
    $item->sale = 'sdadsa';
    $item->is_multi = false;
    $item->min_price = 'adssad';
    $item->in_wish = true;
    $item->in_compare = false;
    $item->cart_amount = 0;

    $item->review = 400;
    $item->delivery_cost = 'Бесплатно';
    $item->productColor = 'белый';

    $items[] = $item;
}

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
    require Root . '/webhtm/shop/user/product-single/css/style.php';
    ?>

</head>


<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php
$this->beginBody();

require Root . '/webhtm/block/header/main.php';
require Root . '/webhtm/block/navbar/main.php';
if(!empty($id))
    echo $this->require( '/render/market/ZYandexSingleProductHeaderWidget/ready/single-product-header.php');
?>



<div id="content" class="container-fluid mt-3 responc">
    <?if (!empty($id)):?>
    <?echo $this->require( '/webhtm/shop/user/product-single/block/yandexTab.php',['id' => $id,
        'type' => 'product']);

    ?>

    <div class="row ">
        <div class="col-12 py-3">
            <?
            $get = $this->sessionGet('catalogForm');

            $productId = (int)ZArrayHelper::getValue($get, 'product_id');
            if ($productId === $id) {
                unset($get['product_id']);
            } else
                $get =[];
            $set = Az::$app->market->cart->getcatalogsByElement($id, $get);

            if (is_array($set))
            echo $this->require( '/webhtm/shop/user/product-single/block/components/table-product.php', ['items'=>$set]
            );
            ?>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col-12 py-3 mb-3">
            <?
            echo $this->require( '/webhtm/shop/user/product-single/block/monitoring_block1.php', ['item' => $set]);
            ?>
        </div>
    </div>
    <?php endif; ?>
    <?
    if(empty($id))
        echo $this->require( '/render/market/NotFound/main.php',[
            'item'=>'К сожалению, данные отсутствуют.'
        ]);
    ?>
</div>

<?php
echo $this->require( '/webhtm/block/SingleProduct/footer.php');
$this->endBody()
?>
</body>
</html>
<?php $this->endPage() ?>






