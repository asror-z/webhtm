.<?php
use zetsoft\system\Az;
use zetsoft\widgets\inputes\ZKStarRatingWidget;
/** @var ZView $this */
use zetsoft\system\kernels\ZView;
?>
<div class="d-flex justify-content-between">
    <div class="fp-20">
        <span class="badge badge-success mr-3"><?= number_format($product->rating,1)?></span>
        <a href="webhtm/shop/user/product/review.php?id=<?=$product->id?>">
            <span class="text-dark mr-3"><?/*=$product->reviewCount.  Az::l(" отзывов")*/?></span>
        </a>

        <a href="webhtm/shop/user/product-single/questions-answers.php?id=<?=$product->id?>">
            <span class="text-dark"><?/*=$product->reviewCount.  Az::l(" вопросов")*/?> </span>
        </a>
    </div>
    <div>
        <a href="#">
            <span class="text-dark mr-3"><?=$product->phone ?></span>
        </a>
        <a href="#">
            <span class="mr-3"><?=$product->website ?></span>
        </a>
        <a href="#">
            <span class="mr-3"><?=$product->email ?></span>
        </a>
    </div>
    <?/*= $this->require('/webhtm/shop/user/market-single/block/wish_and_compare.php', ['product'=>$product]) */?>
</div>
