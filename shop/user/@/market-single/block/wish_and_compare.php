<?php

use zetsoft\system\Az;

?>
<div class="mt-2">
    <div class="d-flex px-2">
        <a class="text-muted mb-1 hint--top"
           aria-label="<?= Az::l('Добавить в избранное') ?>"
           onclick="add_wish_list(<?= $product->id; ?>,$(this),true)"
        >
            <i class="far fa-2x fa-heart <?= $product->in_wish ? 'text-danger' : '' ?>"></i> <span class="fp-18"> <?= Az::l('В избранное') ?></span>
        </a>
       
    </div>
</div>
