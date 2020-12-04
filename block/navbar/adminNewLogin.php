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
        <div class="mx-5 zcrmlogo my-auto">
            <?
            echo ZSVGWidget::widget([
                "config" => [
                    'type' => ZSVGWidget::type['MCRMlogo'],
                    'height' => 50,
                    'width' => 140

                ],
            ]);
            ?>

        </div>
      </div>
  </div>
</div>


<style>
  .navbar, .pagination .page-item.active .page-link {
    box-shadow: 0 0 0 0 rgba(0, 0, 0, .1), 0 0 5px 0 rgba(0, 0, 0, 0.1) !important;
  }

</style>










