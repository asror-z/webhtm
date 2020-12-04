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

    /*.horizontal-vertical-card{
        max-height: 256px;
    }*/


    .signin-cart {
        margin: 20px 0;
        background: white;
        width: 300px;
        position: absolute;
        right: 20px;
        top: 78px;
        border-radius: 3px;
    }
    .signin-cart .shopping-cart-header {
        border-bottom: 1px solid #E8E8E8;
        padding-bottom: 15px;
    }

    .signin-link:hover{
        background-color: #f5f5f5;
    }

    .signin-cart:after {
        bottom: 100%;
        left: 92%;
        border: solid transparent;
        content: " ";
        height: 0;
        width: 0;
        position: absolute;
        pointer-events: none;
        border-bottom-color: white;
        border-width: 8px;
        margin-left: -8px;
    }
    

</style>

<div class="sticky-top pp" id="super_navbar">
    <div class="navbar navbar-transparent d-flex justify-content-center justify-content-sm-between flex-wrap">
        <div class="d-flex justify-content-between" style="max-height: 40px">
            <div class="d-flex">
                <div class="mr-2">
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


        <div class="d-flex align-items-center nav-right">
            <?

            // echo $this->require( '/webhtm/block/navbar/pjaxMessNotFrien.php');

            ?>


            <div class="d-flex align-items-center viewWidgetClass">

                <?

                echo $this->require( '/webhtm/block/navbar/cartWishCompareView.php');

                ?>

            </div>

            <div class="RegisterBlockCarolinaRegisterBtn p-0">

                <?= $this->require( '/webhtm/block/register/register1.php'); ?>


            </div>

        </div>


    </div>
</div>
   






