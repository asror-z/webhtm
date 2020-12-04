<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

use FontLib\Table\Type\name;
use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\shop\ProductItem;
use zetsoft\dbitem\shop\PropertyItem;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\navigat\ZSmartTabAjaxWidgetAZ;
use zetsoft\widgets\navigat\ZYandexTabWidget;

/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Главная страница';
$action->icon = 'fa fa-area-chart';
$action->type = WebItem::type['ajax'];
$action->csrf = true;
$action->debug = true;

$action->cache = false;
$action->cacheHttp = false;

$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

$item = new ProductItem();

$product_id = $this->httpGet('id');

$reviews = Az::$app->market->review->getReviewByProductId($product_id);



/** @var ProductItem[] $product */
$product = Az::$app->market->product->getproducttest();

/** @var PropertyItem[] $productProperty */
$productProperty = [];
$service = Az::$app->market->product->product($product_id);
if ($service !== null)
    $productProperty = $service->allProperties;
Az::$app->market->wish->writeViewed($product_id);


$this->beginPage();
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>

    <?php
    require Root . '/webhtm/block/metas/main.php';
    require Root . '/webhtm/block/assets/main.php';

    $this->head();
    ?>

</head>
<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php
$this->beginBody();


require Root . '/webhtm/block/header/main.php';
require Root . '/webhtm/block/navbar/main.php';

 ?>

 <?
echo $this->require( '/webhtm/shop/user/product/block/yandexTab.php',) ?>


<style>

    .item-structure:after {
        content: "";
        position: absolute;
        left: 10%;
        right: 0;
        margin-top: 1.1em;
        width: 63%;
        height: 1px;
        background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAMAAAABCAAAAAA+i0toAAAAAnRSTlMA/1uRIrUAAAAMSURBVHheY7j1/z8ABY8C2UtBe8oAAAAASUVORK5CYII=) 0 0 repeat-x;
    }
</style>

<div class="container">
    <div class="row pb-3">
        <div class="col-lg-10">

            <div>
                <h2 class="my-4 pb-3">Подробные характеристики</h2>

                <hr>
            </div>
            <div>
                <h4 class="my-4 pb-2">Общие характеристики</h4>
            </div>

            <?php
            foreach ($productProperty as $key => $value) { ?>
                <div class="d-flex justify-content-between fp-18">
                    <div class="item-structure">
                     <span class="title-structure fp-16"><?= $value->name ?>
                    <button type="button" class="btn btn-link p-0 hint--right"
                            aria-label="I'm a tooltip text">
                    <i class="far  fa-question-circle ml-1 text-muted "></i>
                    </button></span>
                    </div>
                    <div class="w-25">
                     <span class="fp-16">
                            <? foreach ($value->items as $_key => $_value) {
                                if (count($value->items) > 1 && !($_key === array_key_first($value->items))) {
                                    echo '/';
                                }
                                echo $_value;
                            }
                            ?>
                     </span>
                    </div>
                </div>
            <? } ?>
        </div>
    </div>
</div>
<div>
    <?=
    $this->require( '/webhtm/block/SingleProduct/footer.php');
    ?>
</div>





