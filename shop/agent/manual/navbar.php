<?php


use zetsoft\models\shop\ShopBrand;
use zetsoft\service\forms\ZPjax;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;

use zetsoft\widgets\ajaxify\ZStatusWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZExpandableSearchWidgetJ;
use zetsoft\widgets\inputes\ZKSelect2Widget;
use zetsoft\widgets\market\ZSVGWidget;


/** @var ZView $this */
$baseUrl = $this->urlGetBase();

$this->fileJs('/render/asrorz/market/js/navbar.js');
//if (!$this->userIsGuest()) ZStatusWidget::widget([]);
echo ZNProgressWidget::widget([]);

$pjax = new ZPjax();
$pjax->id = 'pjax-id';
$this->pjaxBegin($pjax);
?>
<style>
    @media (max-width: 576px) {
        .nav-right {
            margin-top: 10px;
        }
    }
    .modal-backdrop{
        z-index: 0;
    }
    .status-callcenter{
        width: 200px;
    }
</style>
<div class="shadow-sm sticky-top" id="super_navbar">
    <div class="navbar navbar-light d-flex justify-content-center justify-content-sm-between flex-wrap">
        <div class="d-flex justify-content-between" style="max-height: 40px">

        </div>
        <div class="d-none d-lg-block">
            <?php
              //  require Root . '/webhtm/shop/agent/manual/autoDialCheckbox.php';
            ?>
        </div>

        <div class="d-flex align-items-center nav-right">
            <div class="d-blok mr-2 status-callcenter">
                <?php

              //require Root . '/webhtm/block/navbar/statusCheckbox.php';

              require Root . '/webhtm/shop/agent/manual/statusCheckbox.php';


                ?>
            </div>
           <!-- --><?/*= $this->require( '/webhtm/block/navbar/pjaxMessNotFrien.php') */?>

            <div class="RegisterBlockCarolinaRegisterBtn p-0">

                <?= $this->require( '/webhtm/block/register/register.php'); ?>

            </div>

        </div>


    </div>
</div>
<?php
$this->pjaxEnd();
?>





