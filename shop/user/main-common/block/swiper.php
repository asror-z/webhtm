<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */


use zetsoft\models\shop\ShopBanner;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZHTML;
use zetsoft\widgets\market\ZMSwiperWidget;
use zetsoft\widgets\market\ZMSwiperWidget4;

$data = Az::$app->market->banner->getBannerPhotos($market_id);

$href = ZArrayHelper::getValue($data, 'href');
$removeHref = ZArrayHelper::remove($data, 'href');

$photos = ZArrayHelper::getValue($data, 'photos');
//vdd($data);
echo ZMSwiperWidget4::widget([
    'data' => $photos,
    'config' => [
        'slidesPerView' => 1,
        'height' => '50vh',
        'href' => $href,
        'class' => 'p-gfh',
        'mousewheel' => false,
        'slidesMediaPerView640' => 1,
        'slidesMediaPerView500' => 1,
        'slidesMediaPerView1024' => 1,
        'slidesMediaPerView325' => 1,
    ],
]);


?>
<style>
  .swiper-pagination-clickable .swiper-pagination-bullet {
    background: #00c851;
  }
</style>
