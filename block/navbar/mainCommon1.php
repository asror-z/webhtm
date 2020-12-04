<?php


use zetsoft\models\core\ShopBrand;
use zetsoft\models\core\CoreCategory;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;

use zetsoft\widgets\ajaxify\ZStatusWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;

use zetsoft\widgets\market\ZSVGWidget;


/** @var ZView $this */
$baseUrl = $this->urlGetBase();

$this->fileJs('/render/asrorz/market/js/navbar1.js');

if (!$this->userIsGuest()) ZStatusWidget::widget([]);
echo ZNProgressWidget::widget([]);
?>
<style>
    @media (max-width: 576px) {
        .nav-right {
            margin-top: 10px;
        }
    }
    
    .textbox {
        outline: 0;
        height: 42px;
        width: 344px;
        line-height: 42px;
        padding: 0 16px;
        background-color: rgba(255, 255, 255, 0.8);
        color: #212121;
        border: 1px solid #eee;
        float: left;
        -webkit-border-radius: 4px 0 0 4px;
        border-radius: 4px 0 0 4px;
    }

    .textbox:focus {
        outline: 0;
        background-color: #FFF;
    }

    .button-s {
        outline: 0;
        background: none;
        background-color: #0be370;
        float: left;
        height: 42px;
        width: 42px;
        text-align: center;
        line-height: 42px;
        border: 0;
        color: #FFF;
        font: normal normal normal 14px/1 FontAwesome;
        font-size: 16px;
        text-rendering: auto;
        text-shadow: 0 1px 1px rgba(0, 0, 0, 0.2);
        -webkit-transition: background-color .4s ease;
        transition: background-color .4s ease;
        -webkit-border-radius: 0 4px 4px 0;
        border-radius: 0 4px 4px 0;
    }

    .button-s:hover {
        background-color: rgba(0, 150, 136, 0.8);
    }

    .signin-cart, .lang-cart {
        margin: 0;
        background: #fff;
        width: 300px;
        position: absolute;
        right: 0.5%;
        top: 100%;
        border-radius: 3px;
        z-index: 1200;
    }
    .signin-cart .shopping-cart-header, .lang-cart .lang-cart-header {
        border-bottom: 1px solid #E8E8E8;
        padding-bottom: 15px;
    }

    .signin-link:hover{
        background-color: #f5f5f5;
    }

    .signin-cart:after, .lang-cart:after {
        bottom: 100%;
        left: 92%;
        border: solid transparent;
        content: " ";
        height: 0;
        width: 0;
        position: absolute;
        pointer-events: none;
        border-bottom-color: #eee;
        border-width: 8px;
        margin-left: -8px;
    }

</style>
<div class="container">
    <div class="sticky-top w-100" id="super_navbar" style="background: #fff">
        <div class="navbar-transparent p-3  d-flex justify-content-center justify-content-sm-between flex-wrap mainCommon-navbar">
            <div class="d-flex justify-content-between" style="max-height: 40px;">
                <div class="d-flex">
                    <div class="ml-5">
                        <a class="logos" href="<?= $baseUrl ?>">
                            <?
                            echo ZSVGWidget::widget([
                                'config' => [
                                    'type' => ZSVGWidget::type['MarketPlace'],
                                ]
                            ])
                            ?>
                        </a>
                    </div>
                    <div class="d-flex align-items-end " id="h1">

                        <!-- todo: menu main pageda chiqmidi AzizRozmetov -->
                        <?
                        if (Az::$app->request->pathInfo != $this->bootEnv($baseUrl)): ?>

                            <button class="navbar-toggler grey-text" type="button" id="menu_show">
                                <i class="fas fa-bars fr-16"></i>
                            </button>
                            <div class="mt-5 pt-3 fixed-top col-10"
                                 style="position: absolute; left: 0px; top: 0; display: none"
                                 id="navbar_menu">
                                <?
                                echo zetsoft\widgets\market\ZMenuWidget::widget([
                                    'config' => [
                                        'open' => true,

                                        //'name' => 'Категории',
                                        'mode' => 'shop',
                                        'class_position' => '',
                                        'max-width' => '313px',
                                        'menu-widget' => 'menu-widget bg-white text-left',
                                    ],
                                ]);

                                ?>
                            </div>

                        <? endif; ?>
                        <!-- todo: menu main pageda chiqmidi AzizRozmetov -->

                    </div>
                </div>
                <div class="d-none d-lg-block">
                    <div class="d-flex ml-5">
                        <?
                        //echo ZExpandableSearchWidgetJ::widget();
                        ?>
                    </div>
                </div>

            </div>
            <div>
                <input type="text" class="textbox" placeholder="Search">
                <input title="Search" value="" type="submit" class="button-s">
            </div>
            

            <div class="d-flex align-items-center nav-right">




                <div class="d-flex align-items-center viewWidgetClass">

                    <?

                    echo $this->require( '/webhtm/block/navbar/cartWishCompareView-mainPage.php');

                    ?>

                </div>

                <div class="RegisterBlockCarolinaRegisterBtn p-0">

                    <?= $this->require( '/webhtm/block/register/register-mainPage.php'); ?>

                </div>

            </div>


        </div>
    </div>
</div>







