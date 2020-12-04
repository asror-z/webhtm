<?php

/**
 * Author:  Nurmukhammadov Shakhrizod
 */

use zetsoft\system\Az;

//require Root . '/webhtm/core/error/blocks/style.php';
require Root . '/webhtm/core/error/blocks/script.php';
?>
<script src="/render/core/error/main.js"></script>
<!---->
<!--<link rel="stylesheet" href="/render/core/error/main.css">-->
<div class="text-center">
<button type="button" class="btn btn-primary btn-rounded" style="" data-toggle="modal" data-target="#exampleModal">
</button>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= $exception->getMessage()?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                  <?= $handler->renderCallStack($exception) ?>
            </div>

        </div>
    </div>
</div>
