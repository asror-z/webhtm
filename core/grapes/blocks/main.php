<?php

use zetsoft\widgets\inputes\ZKSelect2Widget;

if(!isset($grapeItem)){

   $grapeItem->content = ZKSelect2Widget::widget([
    'name' => 'asd'
   ]);
   
}

?>


<div id="gjs" class="btn-style">
     <?= $grapeItem->content ?>
</div>

