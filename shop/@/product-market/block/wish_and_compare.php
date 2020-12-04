<?php

use zetsoft\system\Az;

$product = Az::$app->market->product->getproducttest();


?>
<div class="mt-2">
    <div class="d-flex px-2">
        <a class="text-muted mb-1 hint--bottom"
           aria-label="<?= Az::l('Добавить в избранное') ?>"
           onclick="add_wish_list(<?= $product->id ?: null ?>,$(this),true)"
        >
            <i class="far fa-heart fa-2x <?= $product->in_wish ? 'text-danger' : '' ?>"></i>
            <span> <?= Az::l('В избранное') ?></span>
        </a>
        <a class="text-muted ml-4 mb-1 hint--top"
           aria-label="<?= Az::l('Добавить к сравнению') ?>"
           onclick="add_compare_list(<?= $product->id ?: null ?>,$(this),false)"
        >
            <i class="far fa-chart-bar fa-2x <?= $product->in_compare ? 'text-success' : '' ?>"> </i>
            <span> <?= Az::l('Сравнить') ?></span>
        </a>
    </div>
</div>
