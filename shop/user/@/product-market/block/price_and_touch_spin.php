<?php

use zetsoft\widgets\inputes\ZKTouchSpinWidget;
use zetsoft\widgets\market\ZSVGWidget;

?>
<div class="row">
    <div class="col-md-3 ml-2 mt-2">
        <a>
            <span class="price_old text-danger"><del class="fp-30">18,900</del></span>
            <span class="discount fp-20 text-danger ml-5">скидка:8000 UZS</span>
        </a>
        <br>
        <a>
            <span class="fp-35 text-success">20,000</span>
            <span class="fp-25 text-light"> сум за 1 шт.</span>
        </a>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        <div class="d-flex">
            <?php
            echo ZKTouchSpinWidget::widget([
                'name' => 'name',
                'config' => [
                    'min' => '0',
                    'max' => '10000',
                    'step' => '1',
                    'buttonup_txt' => '<i class="fa fa-plus fa-2x"></i>',
                    'buttondown_txt' => '<i class="fa fa-minus text-danger fa-2x"></i>',
                    'buttonup_class' => 'btn btn-outline-success btn-sm',
                    'buttondown_class' => 'btn btn-outline-danger btn-sm',
                    'class' => 'text-center touch-single'
                ],
            ]);
            ?>
              <div class="d-block ml-1 mt-1">
            <?php
            echo ZSVGWidget::widget([
                'config' => [
                    'type' => 'basket_delete'
                ]
            ])
            ?>
            </div>
        </div>

