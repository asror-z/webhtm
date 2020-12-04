<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */


use zetsoft\widgets\market\ZMSwiperWidget;
use zetsoft\widgets\market\ZMSwiperWidget4;

echo ZMSwiperWidget4::widget([
    'data' => [
        'https://gcdn.utkonos.ru/resample/940x300q95/images/banner/2020/05/19/46657_234607.png',
        'https://gcdn.utkonos.ru/resample/940x300q95/images/banner/2020/04/22/46006_145036.jpg',
        'https://gcdn.utkonos.ru/resample/940x300q95/images/banner/2020/05/19/46637_233144.jpg',
        'https://gcdn.utkonos.ru/resample/940x300q95/images/banner/2020/05/19/46645_233631.jpg',
        'https://gcdn.utkonos.ru/resample/940x300q95/images/banner/2020/05/07/44049_133221.jpg',
    ],
    'config' => [
        'slidesPerView' => 1,
        'height' => '50vh',
        'class' => 'p-gfh',
        'mousewheel' => false,
        'slidesMediaPerView640' => 1,
        'slidesMediaPerView500' => 1,
        'slidesMediaPerView1024' => 1,
        'slidesMediaPerView325' => 1,
    ],
]);











 ?>
