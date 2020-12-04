<?php
/** @var ZView $this */

use zetsoft\dbitem\core\WebItem;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\navigat\ZButtonWidget;

if (!isset($item)) $item='safdadsa';
?>
<div class="col-12">
    <div class="text-center d-block">

        <i class="fas fa-shopping-basket fa-10x text-light"></i>

        <h3 class="mt-5 text-muted">
            <?= Az::l($item) ?>
        </h3>


        <br>

        <?
        echo ZButtonWidget::widget([
            'config' => [
                'text' => 'Перейти к покупкам',
                'color' => ZColor::color['green'],
                'class' => '',
                'url' => '/shop/user/main/main.aspx',
                'btnStyle' => ZButtonWidget::btnStyle['btn-success'],
                'btnSize' => ZColor::btnSize['btn-md'],
                'btnFontSize' => ZButtonWidget::btnScale['0.5'],
                'btnRounded' => false,
            ],

        ]);
        ?>
    </div>

</div>
