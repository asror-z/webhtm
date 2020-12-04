<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */
use zetsoft\models\shop\ShopCatalog;
use zetsoft\system\Az;
use zetsoft\widgets\iconers\ZLangPickerWidget;
use zetsoft\widgets\inputes\ZSelect2Widget;

?>


<div class="d-flex justify-content-between p-1 topheader" style="background: #fafafa;">
    <div class="d-flex justify-content-around flex-wrap">
        <div class="">
            <i class="fas fa-phone text-muted my-auto"></i>
            <a href="#" class="fp-15 text-muted">+998 90 123 45 67</a>
        </div>
        <div>
            <a href="/cores/info/help.aspx" class="fp-15 text-muted">Помощь</a>
        </div>
        <div>
            <a href="/cores/info/support-service.aspx" class="fp-15 text-muted">Служба поддержки</a>
        </div>
    </div>
    
    <div class="d-flex justify-content-around flex-wrap">
        <div>
            <?php
            require Root . '/webhtm/block/navbar/currencyCheckbox.php';
            ?>
        </div>
        <div class="d-flex align-items-center">
            <?
            echo ZLangPickerWidget::widget();
            ?>
        </div>
    </div>
</div>



