<?php

use zetsoft\widgets\market\ZSVGWidget;
use zetsoft\widgets\menus\ZMetisMenuWidget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\menus\ZMmenuWidget_Axror1;
use zetsoft\widgets\menus\ZMmenuWidgetSh;
use zetsoft\widgets\menus\ZMmenuWidgetSh_Axror;


$baseUrl = $this->urlGetBase();

$widget = ZSVGWidget::widget([
    'config' => [
        'type' => 'MarketPlace',
    ]
    
]);
$iconla = $this->require( '/webhtm/block/navbar/cartWishCompareView.php') ;


echo ZMmenuWidget::widget([
    //'data' => $this->cores->menus->create('mmenu'),
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
       // 'menu-effect-slide' => true,
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




