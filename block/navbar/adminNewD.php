<?php


use zetsoft\system\kernels\ZView;
use zetsoft\widgets\ajaxify\ZStatusWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\market\ZSVGWidget;

/*if (!$this->userIsGuest()) ZStatusWidget::widget([]);*/
/** @var ZView $this */
$baseUrl = $this->urlGetBase();

$this->fileJs('/render/asrorz/market/js/umid.js');

echo ZNProgressWidget::widget([]);

?>

<div class="sticky-top">
  <div class="navbar d-flex">
    <div class="d-flex justify-content-start">
      <div class="d-flex justify-content-start">
        <div class="mx-auto w-">
           <span id="hamburger" class="sticky text-muted mx-2">
                <a class="logos mburger mburger--collapse p-0" href="#menu">
                    <i class="fal fa-bars"></i>
                </a>
           </span>
        </div>
        <div class="mx-2 zcrmlogo my-auto">
            <?
            echo ZSVGWidget::widget([
                "config" => [
                    'type' => ZSVGWidget::type['MCRMlogo'],
                    'height' => 30,
                    'width' => 100

                ],
            ]);
            ?>

        </div>
      </div>
    </div>
    <div>
      <div class="RegisterBlockCarolinaRegisterBtn p-0">

          <?= $this->require('/webhtm/block/register/register.php'); ?>

      </div>
    </div>
  </div>
</div>


<style>
  .navbar, .pagination .page-item.active .page-link {
    box-shadow: 0 0 0 0 rgba(0, 0, 0, .1), 0 0 5px 0 rgba(0, 0, 0, 0.1) !important;
  }

</style>










