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
use zetsoft\models\shop\ShopOffer;
use zetsoft\models\shop\ShopOfferType;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\widgets\market\ZMSwiperWidget;
use zetsoft\widgets\market\ZMSwiperWidget4;

$slide_data = [];
$status='deal_of_day';

/*$categorys = Az::$app->market->product->offerCategoriesWithProducts($status, null, 3);*/

$categorys = Az::$app->market->offer->offerCategoriesWithProducts(null, 3, null, 3);

//vdd($categorys);

foreach ($categorys as $category) {
   // $products_num = count($category->items);
    $slide_data[] = $this->require( '/render/cards/ZMiniCardWidget/ready/clean_mini_cards_container.php', [
        'categoryId' => $category->id,
        'categoryName' => $category->name,
        'categoryUrl' => $category->url,
        'products_num' => $category->items,
        'status' => $status
    ]);

}


echo ZMSwiperWidget4::widget([
    'data' => $slide_data,
    'config' => [
        'slideWidget' => true,
        'slidesPerView' => 4,
        'pagination.el' => '',
        'slidesMediaPerView640' => 2,
        'slidesMediaPerView500' => 2,
        'slidesMediaPerView1024' => 2,
        'slidesMediaPerView325' => 1,
        'nextEl' => '.swiper-button-next',
        'prevEl' => '.swiper-button-prev',
        'loop' => false,
        'height_class' => 'py-1',
        'mousewheel' => false,
    ]
]);

?>

<style>
    .swiper-button-next, .swiper-button-prev {
        z-index: 9999999999;
    }
</style>
