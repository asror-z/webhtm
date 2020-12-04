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
use zetsoft\dbitem\shop\PropertyItem;
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

$items = new MultiProductItem();

$items->id = 18;
$items->catalogId = 19;
$items->name = 'Product Name';
$items->amount = 0;
$items->properties = [
    $property,
    $property,
    $property,
];
$items->allProperties = [
    $property
];
$items->status = ['new', 'hot_)', 'sale'];
$items->categoryId = 20;
$items->categoryName = 'catalogName';
$items->categoryUrl = '';
$items->title = '';
$items->text = '';
$items->brand = '';
$items->brandImage = '';
$items->rating = '';
$items->reviewCount = 8;
$items->url = '';
$items->visible = true;
$items->images = [];
$items->is_multi = true;
$items->in_wish = '';
$items->in_compare = '';
$items->cart_amount = '';
$items->items = [];
$items->barcode = '';
$items->max_price = 5200;
$items->min_price = 4500;


$slide_data = [];
$type = 'new';
foreach ($items as $item) {
    if (ZArrayHelper::isIn('new', $items->status)) {
        $slide_data[] = $this->require( '/render/cards/ZMiniCardWidget/ready/clean_mini_cards_container.php', [
            'item' => $items,
            'type' => $type,
            'col'=>12
        ]);
    }
}


echo ZMSwiperWidget::widget([
    'data' => $slide_data,
    'config' => [
        'slideWidget' => true,
        'slidesPerView' => 2,
        'pagination.el' => '',
        'slidesMediaPerView640' => 4,
        'slidesMediaPerView500' => 3,
        'slidesMediaPerView1024' => 3,
        'slidesMediaPerView325' => 2,
        'nextEl' => '.swiper-button-next',
        'prevEl' => '.swiper-button-prev',
        'swip-nor' => 'pb-2',
        'height_class' => 'h-100',
        'loop' => false,
        'mousewheel' => false,
    ]
]);

