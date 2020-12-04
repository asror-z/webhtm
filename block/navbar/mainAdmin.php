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


use zetsoft\models\core\ShopBrand;
use zetsoft\models\core\CoreCategory;
use zetsoft\system\kernels\ZView;

use zetsoft\widgets\former\ZExpandableSearchWidgetJ;
use zetsoft\widgets\market\ZSVGWidget;


/** @var ZView $this */
$baseUrl = $this->urlGetBase();


?>

<div class="shadow-sm sticky-top">

<!--    <div class="navbar navbar-light d-flex justify-content-end justify-content-lg-end flex-wrap">-->
<!--        <div class="row">-->
<!--            <div class="col-4">-->
<!--                <div class="float-right">-->
<!--                    <a href="#menu" class="mburger mburger--collapse">-->
<!--                        <i class="fas fa-bars fa-2x mr-2 mt-2 text-muted fp-35"></i>-->
<!--                    </a>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-8">-->
<!--                <div class="float-right ">-->
<!--                    <div class="RegisterBlockCarolinaRegisterBtn p-0 justify-content-between d-flex">-->
<!--                        --><?//= $this->require( '/webhtm/block/register/register.php'); ?>
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
    <div class="navbar navbar-light d-flex justify-content-between justify-content-between flex-wrap">
        <div class="row">
            <div >
                <div class="float-right">
                    <a href="#menu" class="mburger mburger--collapse">
                        <i class="fas fa-bars fa-2x mr-2 mt-2 text-muted fp-35"></i>
                    </a>
                </div>
            </div>
        </div>

     <div class="row d-flex justify-content-end justify-content-lg-end flex-wrap">
            <div >
                <div class="float-right ">
                    <div class="RegisterBlockCarolinaRegisterBtn p-0 justify-content-between d-flex">
                        <?= $this->require( '/webhtm/block/register/register.php'); ?>
                    </div>
                </div>
            </div>
    </div>
    </div>
    </div>



</div>


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



