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

echo ZMSwiperWidget::widget([
    'data' => [
        'https://bozorboy.com/pictures/brand/4589.png',
        'https://bozorboy.com/pictures/brand/4726.png',
        'https://bozorboy.com/pictures/brand/4868.png',
        'https://bozorboy.com/pictures/brand/4728.png',
        'https://bozorboy.com/pictures/brand/4831.png',
        'https://bozorboy.com/pictures/brand/4725.gif',
        'https://bozorboy.com/pictures/brand/4612.jpg',
        'https://bozorboy.com/pictures/brand/4746.png',
        'https://bozorboy.com/pictures/brand/4782.jpg',
        'https://bozorboy.com/pictures/brand/4832.jpg',
        'https://bozorboy.com/pictures/brand/4750.png',
    ],
    'config' => [
        'slidesPerView' => 5,
        'class' => 'brand',
        'height' => '170px',
        'width' => '150px',
        'mousewheel' => false,
        'pagination.el' => '',
        'slidesMediaPerView640' => 3,
        'slidesMediaPerView500' => 3,
        'slidesMediaPerView1024' => 5,
        'slidesMediaPerView325' => 2,
    ],
]);
