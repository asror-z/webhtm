<?php

use zetsoft\dbitem\wdg\MenuItem;
use zetsoft\models\shop\ShopCategory;
use zetsoft\system\Az;
use zetsoft\widgets\menus\ZMenuItemWidget;


$category_id = 100;
/* 137
 * $category_id = $this->httpGet('id');
;
$parent->name = 'asdasd';
$parent->id = 1;*/
$parent = ShopCategory::findOne(137);


///$item = new MenuItem();
$item = Az::$app->market->category->getItems($parent);
   
?>

<div class="col-12 border border-light rounded">
    <h4 class="mt-2">Смежные категории</h4>
    <?php
        echo ZMenuItemWidget::widget([
            'config' => [
                'menuItem' => $item
            ]
        ]);

    ?>
</div>
