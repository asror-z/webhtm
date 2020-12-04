<?php

use zetsoft\system\Az;
use zetsoft\widgets\inputes\ZKStarRatingWidget;
use zetsoft\widgets\market\ZSVGWidget; ?>
<div class="mt-2 d-flex align-items-center">
    <!--<img width="35" height="40" src="/render/market/ZGlotrCardWidget/medal_new.svg">-->
    <?

    
    echo ZSVGWidget::widget([
        'config' => [
            'type' =>  ZSVGWidget::type['top_sell'],
        ]
    ]);

    echo ZKStarRatingWidget::widget([
        'name' => 'name',
        'value' => 3,
        'config' => [
            'show' => false,
            'icon' => '<i class="fas fa-star"></i>',
            'size' => 'xs',
            'isDisplayOnly' => true,
            'iStars' => 5,
        ]
    ]);
    ?>
    <a href="#" >
         <span>
            <?= 3; ?>&nbsp;<?= Az::l('Отзыва') ?>
         </span>
    </a>
</div>

<div class="mt-2 d-flex flex-column align-items-center">

</div>
