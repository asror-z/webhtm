<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */


use zetsoft\dbitem\shop\MultiProductItem;
use zetsoft\dbitem\shop\ProductItem;
use zetsoft\dbitem\shop\PropertyItem;
use zetsoft\models\shop\ShopProduct;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\widgets\market\ZMSwiperWidget;

//$items = Az::$app->market->product->getTestProducts();
$property = new PropertyItem();
$property->name = '182sad';
$property->branch = '00421sa';
$property->items = [
    'huihuih',
    'okjio',
    'juijiio'
];

$item = new MultiProductItem();

$item->id = 18;
$item->catalogId = 19;
$item->name = 'Product Name';
$item->amount = 0;
$item->properties = [
    $property,
    $property,
    $property,
];
$item->allProperties = [
    $property
];
$item->status = ['new', 'hot', 'sale'];
//vdd($item->status);
$item->categoryId = 20;
$item->categoryName = 'catalogName';
$item->categoryUrl = '';
$item->title = '';
$item->text = '';
$item->brand = '';
$item->brandImage = '';
$item->rating = '';
$item->reviewCount = 8;
$item->url = '';
$item->visible = true;
$item->images = ['https://images.pexels.com/photos/1095550/pexels-photo-1095550.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500',
    'https://images.pexels.com/photos/461198/pexels-photo-461198.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500',
    'https://previews.123rf.com/images/veneratio/veneratio1511/veneratio151100044/48203428-landscape-iamge-of-river-flowing-through-lush-green-forest-in-summer.jpg',
    'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcRVDh2D2fzRSBYnwaA-70G74wjOeeZWbRnEVBMxfu1jVqcP9fMv&usqp=CAU',];
$item->is_multi = true;
$item->in_wish = '';
$item->in_compare = '';
$item->cart_amount = 4;
$item->item = [];
$item->barcode = '';
$item->max_price = 5200;
$item->min_price = 4500;
$type = 'sale';
$items[] = $item;
$slide_data=[];
/*$items = Az::$app->market->product->productByStatus(457, ProductItem::statuses['new']);*/
foreach ($items as $item) {
    $slide_data[] = $this->require( '/render/cards/ZVMarketWidget/ready/main.php', [
        'item' => $item,
        'type' => $type,
        'col' => 12
    ]);


}

echo ZMSwiperWidget::widget([
    'data' => $slide_data,
    'config' => [
        'slideWidget' => true,
        'slidesPerView' => 2,
        'pagination.el' => '',
        'slidesMediaPerView640' => 5,
        'slidesMediaPerView500' => 3,
        'slidesMediaPerView1024' => 2,
        'slidesMediaPerView325' => 2,
        'nextEl' => '.swiper-button-next',
        'prevEl' => '.swiper-button-prev',
        'swip-nor' => 'pb-2',
        'height_class' => 'h-100',
        'loop' => false,
        'mousewheel' => false,
    ]
]);

?>

