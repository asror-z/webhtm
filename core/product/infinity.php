<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\webs\lists;


use zetsoft\dbitem\shop\ProductItem;
use zetsoft\dbitem\shop\SingleProductItem;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;

$page = $this->httpGet('page');
$limit = $this->httpGet('limit');
$isTest = $this->httpGet('test');
$isCommon = $this->httpGet('isCommon');
$args = $this->httpGet('args');
$requireUrl = '/webhtm/shop/user/filter-common/blocks/vertical_horizontal.php';

#region Fake
$items_test = [];

$item = new SingleProductItem();
$item->id = $this->myId();
$item->name = 'Арахисовая паста с медом 200г';
$item->title = 'Test Desc';
$item->new_price = '14825920';
$item->price_old = '188920';
$item->barcode = '34234234';
$item->exist = ProductItem::exists['not'];
$item->images = [
    'https://images.pexels.com/photos/1095550/pexels-photo-1095550.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500',
    'https://images.pexels.com/photos/461198/pexels-photo-461198.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500',
    'https://previews.123rf.com/images/veneratio/veneratio1511/veneratio151100044/48203428-landscape-iamge-of-river-flowing-through-lush-green-forest-in-summer.jpg',
    'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcRVDh2D2fzRSBYnwaA-70G74wjOeeZWbRnEVBMxfu1jVqcP9fMv&usqp=CAU',
];
$item->currency = 'сум';
$item->currencyType = 'after';
$item->measure = 'шт';
$item->rating = 3.5;
$item->discount = -10;
$item->catalogId = 19;
$item->sale = 'sdadsa';
$item->is_multi = false;
$item->in_wish = true;
$item->in_compare = false;

$items_test[] = $item;

$item = new SingleProductItem();
$item->id = $this->myId();
$item->name = 'Арахисовая паста с медом 200г';
$item->title = 'Test Desc';
$item->new_price = '14825920';
$item->price_old = '188920';
$item->barcode = '34234234';
$item->exist = ProductItem::exists['not'];
$item->images = [
    'https://images.pexels.com/photos/1095550/pexels-photo-1095550.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500',
    'https://images.pexels.com/photos/461198/pexels-photo-461198.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500',
    'https://previews.123rf.com/images/veneratio/veneratio1511/veneratio151100044/48203428-landscape-iamge-of-river-flowing-through-lush-green-forest-in-summer.jpg',
    'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcRVDh2D2fzRSBYnwaA-70G74wjOeeZWbRnEVBMxfu1jVqcP9fMv&usqp=CAU',
];
$item->currency = 'сум';
$item->currencyType = 'after';
$item->measure = 'шт';
$item->rating = 3.5;
$item->discount = -10;
$item->catalogId = 19;
$item->sale = 'sdadsa';
$item->is_multi = false;
$item->in_wish = true;
$item->in_compare = false;

$items_test[] = $item;

$item = new SingleProductItem();
$item->id = $this->myId();
$item->name = 'Арахисовая паста с медом 200г';
$item->title = 'Test Desc';
$item->new_price = '14825920';
$item->price_old = '188920';
$item->barcode = '34234234';
$item->exist = ProductItem::exists['not'];
$item->images = [
    'https://images.pexels.com/photos/1095550/pexels-photo-1095550.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500',
    'https://images.pexels.com/photos/461198/pexels-photo-461198.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500',
    'https://previews.123rf.com/images/veneratio/veneratio1511/veneratio151100044/48203428-landscape-iamge-of-river-flowing-through-lush-green-forest-in-summer.jpg',
    'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcRVDh2D2fzRSBYnwaA-70G74wjOeeZWbRnEVBMxfu1jVqcP9fMv&usqp=CAU',
];
$item->currency = 'сум';
$item->currencyType = 'after';
$item->measure = 'шт';
$item->rating = 3.5;
$item->discount = -10;
$item->catalogId = 19;
$item->sale = 'sdadsa';
$item->is_multi = false;
$item->in_wish = true;
$item->in_compare = false;

$items_test[] = $item;

#endregion

$exploded = explode('|', $args);

foreach ($exploded as $key => $item1) {
    $item1 !== 'null'
        ? $exploded[$key] = (int)$item1
        : $exploded[$key] = null;
}

$category_id = ZArrayHelper::getValue($exploded, 0);
$market_id = ZArrayHelper::getValue($exploded, 1);

$items = Az::$app->market->product->allProducts($category_id, $market_id, (int)$page, (int)$limit);

if ($isTest)
    $items = $items_test;

$html = null;

foreach ($items as $item) {

    $html .= $this->require( $requireUrl, [
        'item' => $item,
        'isCommon' => $isCommon
    ], 'key' . $item->id);

}

echo $html;

