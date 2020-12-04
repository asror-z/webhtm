<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */


use zetsoft\dbitem\shop\ProductItem;
use zetsoft\dbitem\wdg\MenuItem;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\widgets\market\ZMSwiperWidget;

$slide_data = [];

$topCells = Az::$app->market->product->productByStatus(457, ProductItem::statuses['top_sell']);
$news = Az::$app->market->product->productByStatus(458, ProductItem::statuses['new']);
$sales = Az::$app->market->product->productByStatus(411, ProductItem::statuses['sale']);






foreach ($topCells as $topCell) {
    echo $this->require( '/render/cards/ZMiniCardWidget/clean_3.php', ['item' => $topCell]);
}
foreach ($news as $new) {
    echo $this->require( '/render/cards/ZMiniCardWidget/clean_3.php', ['item' => $new]);
}
foreach ($sales as $sale) {
    echo $this->require( '/render/cards/ZMiniCardWidget/clean_3.php', ['item' => $sale]);
}

//echo $this->require( '/render/cards/ZMiniCardWidget/clean_3.php', ['item' => $product]);
