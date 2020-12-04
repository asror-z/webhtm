<?php
// _list_item.php
use yii\helpers\Html;
use yii\helpers\Url;
?>

<article class="item" data-key="<?= $shopOrderItem->id; ?>">
    <h2 class="title">
        <?= Html::a(Html::encode($shopOrderItem->name), Url::toRoute(['post/show', 'id' => $shopOrderItem->id]), ['title' => $shopOrderItem->name]) ?>
    </h2>

    <div class="item-excerpt">
        <?= Html::encode($shopOrderItem->input); ?>
    </div>
</article>
