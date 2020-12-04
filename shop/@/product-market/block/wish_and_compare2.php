<?php

use zetsoft\system\Az;

?>
<div class="mt-2">
    <div class="d-flex px-2">
        <a class="text-muted mb-1 hint--top"
           aria-label="<?= Az::l('Добавить в избранное') ?>"
           onclick="add_wish_list(<?= $product->id; ?>,$(this),true)"
        >
            <i class="far fa-heart <?= $product->in_wish ? 'text-danger' : '' ?>"></i> <span> <?= Az::l('В избранное') ?></span>
        </a>
        <a class="text-muted ml-4 mb-1 hint--top"
           aria-label="<?= Az::l('Добавить к сравнению') ?>"
           onclick="add_compare_list(<?= $product->id; ?>,$(this),false)"
        >
            <i class="far fa-chart-bar <?= $product->in_compare ? 'text-success' : '' ?>"> </i> <span> <?= Az::l('Сравнить') ?></span>
        </a>
    </div>
</div>
