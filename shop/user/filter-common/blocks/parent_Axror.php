<?php

use zetsoft\dbitem\wdg\MenuItem;
use zetsoft\models\shop\ShopCategory;
use zetsoft\system\Az;
use zetsoft\widgets\menus\ZMenuItemWidget;
use zetsoft\widgets\navigat\ZReadMoreWidget;


$category_id = 137;
//$category_id = $this->httpGet('id');

$parent->name = 'asdasd';
$parent->id = 1;
$parent = ShopCategory::findOne(137);

?>

<div class="col-12">
    <h4 class="mt-2">Смежные категории</h4>
    <?php
    echo ZMenuItemWidget::widget([
        'config' => [
            'menuItem' => $item,

        ]
    ]);
    echo ZReadMoreWidget::widget([
        'config' => [
            'parentclass' => 'menu-container',
            'itemInSummary' => 12,
            'itemClass' => 'mode',
        ]
    ])
    ?>
</div>
