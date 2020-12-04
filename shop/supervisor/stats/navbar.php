<?php


use zetsoft\models\core\ShopBrand;
use zetsoft\models\core\CoreCategory;
use zetsoft\system\kernels\ZView;

use zetsoft\widgets\ajaxify\ZStatusWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZExpandableSearchWidgetJ;
use zetsoft\widgets\market\ZSVGWidget;


/** @var ZView $this */
$baseUrl = $this->urlGetBase();

$this->fileJs('/render/asrorz/market/js/navbar.js');
if (!$this->userIsGuest()) ZStatusWidget::widget([]);
echo ZNProgressWidget::widget([]);
?>
<style>
    @media (max-width: 576px) {
        .nav-right {
            margin-top: 10px;
        }
    }
</style>
<div class="shadow-sm sticky-top" id="super_navbar">
    <div class="navbar navbar-light d-flex justify-content-center justify-content-sm-between flex-wrap">
        <div class="d-flex justify-content-between" style="max-height: 40px">

        </div>
        <!--<div class="d-none d-lg-block">
            <?php
/*                require Root . '/webhtm/shop/agent/manual/autoDialCheckbox.php';
            */?>
        </div>-->

        <!--<div class="d-flex align-items-center nav-right">
            <div class="d-none d-lg-block">
                <?php
/*
              //require Root . '/webhtm/block/navbar/statusCheckbox.php';
              require Root . '/webhtm/shop/agent/manual/statusCheckbox.php';
                */?>
            </div>
            <?/*= $this->require( '/webhtm/block/navbar/pjaxMessNotFrien.php') */?>

            <div class="RegisterBlockCarolinaRegisterBtn p-0">

                <?/*= $this->require( '/webhtm/block/register/register.php'); */?>

            </div>-->

        </div>


    </div>
</div>

<style>
    .modal-backdrop{
        z-index: 0;
    }
</style>






