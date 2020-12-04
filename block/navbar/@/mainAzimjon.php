<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */


use zetsoft\system\kernels\ZView;

use zetsoft\widgets\former\ZExpandableSearchWidgetJ;
use zetsoft\widgets\market\ZSVGWidget;


/** @var ZView $this */
$baseUrl = $this->urlGetBase();


?>

<nav class="shadow-sm sticky-top" id="menu" >
    <div class="navbar navbar-light d-flex justify-content-center justify-content-md-between flex-wrap">
        <div class="d-flex justify-content-between">
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
                <div class="d-flex align-items-end">
                    <button class="navbar-toggler grey-text" type="button" id="menu_show">
                        <i class="fas fa-bars fr-16"></i>
                    </button>
                    <div class="mt-5 pt-3 fixed-top col-3"
                         style="position: absolute;left: 0px;z-index: 999;display: none"
                         id="navbar_menu">
                        <?
                        echo zetsoft\widgets\market\ZMenuWidget::widget([
                            'config' => [
                                'open' => true,
                                //'name' => 'Категории',
                                'mode' => 'shop',
                                'class_position' => '',
                                'menu-widget' => 'menu-widget bg-white text-left py-2',
                            ],
                        ]);
                        ?>
                    </div>
                </div>
            </div>
            <div class="d-flex ml-5">
                <?
                echo ZExpandableSearchWidgetJ::widget();
                ?>
            </div>
        </div>


        <div class="d-flex align-items-center">


            <div class="d-flex align-items-center viewWidgetClass">
                <?= $this->require( '/webhtm/block/navbar/pjaxMessNotFrien.php') ?>
                <?= $this->require( '/webhtm/block/navbar/cartWishCompareView.php') ?>

            </div>

            <div class="RegisterBlockCarolinaRegisterBtn p-0">

                <?= $this->require( '/webhtm/block/register/register.php'); ?>

            </div>

        </div>


    </div>
</nav>


<script>
    $(document).ready(function () {


        $('#menu_show').on('click', function () {
            let icon_menu = $('#menu_show i');
            if (icon_menu.hasClass('fa-bars')) {
                icon_menu.removeClass('fa-bars');
                icon_menu.addClass('fa-times');

            } else {
                icon_menu.addClass('fa-bars');
                icon_menu.removeClass('fa-times');

            }
            $('#navbar_menu').toggle();
            console.log('sdasdas')
        })


    });

</script>



