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
use zetsoft\system\helpers\ZHTML;
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


$product_id = $this->httpGet('id');
if ($product_id === null) {
    echo ZHTML::tag('div', Az::l('Из-за отсутствия идентификатора показаны тестовые продукты '), [
        'class' => 'alert alert-warning',
        'role' => 'alert'
    ]);
}

$get = $this->sessionGet('catalogForm');
$productId = ZArrayHelper::getValue($get, 'product_id');
unset($get['product_id']);

if (is_array($get))
    $set = Az::$app->market->cart->getCatalogsByElement($product_id, $get);

if (!isset($set) || empty($set)) {
    $set = [];

    $item = new ShopCompanyCardForm();
    $item->name = 'Korzinka';

    $item->new_price = '15.555';
    $item->image = 'https://png2.cleanpng.com/sh/75903e9dcfe3b12778615625e127aa30/L0KzQYi4UsE4N5UAfZGAYUO5RLO7VPVmPWpoS5C5MUSzRYi8V8E2OWQ6SKkBNUK8R4e6TwBvbz==/5a364b44ee59c3.0140575715135076529763.png';
    $set[] = $item;
    $item = new ShopCompanyCardForm();
    $item->name = 'Redtag';

    $item->image = 'https://png2.cleanpng.com/sh/98851300f08aaa0951ece0d7f53bf371/L0KzQYm3V8I5N5h4jZH0aYP2gLBuTfdwd5hxfZ91b3fyPbP8kBlvbaR4Rd9yY4Lyg7FtlL14cZ9phAl8LXBzdcPolPlvb154keV9ZX2wRbO8gBI6QZZpetNvZkKxQIG6VsczQWk2TaU7OEC2RIm9WMk6QV91htk=/kisspng-google-logo-business-microsoft-windows-operating-system-5b5cb99edbaff2.0036729815328034868999.png';
    $item->new_price = '10.555';
    $set[] = $item;
}

$product = Az::$app->market->product->product($product_id);


if (!isset($product) || $product === null) {
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
require Root . '/webhtm/block/navbar/main.php';

?>

<div id="content" class="container-fluid mt-3">
    <?
    echo $this->require( '/render/market/ZYandexSingleProductHeaderWidget/ready/single-product-header.php');

    echo $this->require( '/webhtm/shop/user/product-single/block/yandexTab.php',
        [
            'id' => $product_id,
            'type' => 'product'
        ]);
    ?>
    <div class="row">
        <div class="col-12 py-3">
            <?
            echo $this->require( '/webhtm/shop/user/product-single/block/components/table-productD.php', ['items' => $product]
            );
            ?>
        </div>
    </div>
</div>
<div>
    <?=
    $this->require( '/webhtm/block/SingleProduct/footer.php');
    ?>
</div>
<?php $this->endBody(); ?>
</body>

</html>
<?php $this->endPage() ?>




