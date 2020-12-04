<?php

use zetsoft\widgets\market\ZSVGWidget;
use zetsoft\widgets\menus\ZMetisMenuWidget;
use zetsoft\widgets\menus\ZMmenuWidget;



$baseUrl = $this->urlGetBase();

$widget = ZSVGWidget::widget([
    'config' => [
        'type' => 'MarketPlace',
    ]
]);
$iconla = $this->require( '/webhtm/block/navbar/cartWishCompareView.php') ;


echo ZMmenuWidget::widget([
    'config' => [
        'isAll' => true,
        'theme' => 'white',
        'content.img.width' => 400,
        'iconbar.top' => [
            "<a href='#/'><i class='fa fa-home'></i>cc</a>",
            "<a href='#/'><i class='fa fa-home'></i>cc</a>",
        ],
        'iconbar.bottom' => [
            "<a href='#/'><i class='fa fa-home'></i>aa</a>",
            "<a href='#/'><i class='fa fa-home'></i>cc</a>",
        ],
        'all.border' => ZMmenuWidget::border['border-full'],
        'position' => ZMmenuWidget::position['position-front'],
        'content' => <<<HTML
            <div class="d-flex flex-column">
                <div class="zlogo mt-5" >
               <i class="far fa-user text-success fa-4x"></i>
                </div>
                    <div class="my-3">{$widget}</div>
                    <div>
                    {$iconla}
</div>
            </div>
           
HTML,




    ],
])
?>




