<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

use zetsoft\dbitem\data\TabItem;
use zetsoft\models\shop\ShopQuestion;
use zetsoft\models\shop\ShopReview;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;

$product_id = $this->httpGet('id');



//$countQuestion = Az::$app->market->question->countQuestionsById($product_id,$type);
//$countReview = Az::$app->market->question->countReviewsById($product_id,$type);
$countQuestion=5;
$countReview=3;

$pathUrl = '/' . Az::$app->request->pathInfo . '?' . Az::$app->request->queryString;

$tabItems = [];
$tabItem = new TabItem();
$tabItem->url = '/shop/user/product-market/common.aspx?id=' . $product_id;
$tabItem->title = Az::l('Описание');
$tabItem->active = $pathUrl === $tabItem->url;
$tabItems[] = $tabItem;

$tabItem = new TabItem();
$tabItem->url = '/shop/user/product-market/characteristics.aspx?id=' . $product_id;
$tabItem->title = Az::l('Характеристика');
$tabItem->active = $pathUrl === $tabItem->url;
$tabItems[] = $tabItem;

$tabItem = new TabItem();
$tabItem->url = '/shop/user/product-market/price.aspx?id=' . $product_id;
$tabItem->title = Az::l('Цены');
$tabItem->active = $pathUrl === $tabItem->url;
$tabItems[] = $tabItem;

$tabItem = new TabItem();
$tabItem->url = '/shop/user/product-market/review.aspx?id=' . $product_id;
$tabItem->title = Az::l('Отзывы').' '.$countReview;
$tabItem->active = $pathUrl === $tabItem->url;
$tabItems[] = $tabItem;

$tabItem = new TabItem();
$tabItem->url = '/shop/user/product-market/questions-answers.aspx?id=' . $product_id;
$tabItem->title = Az::l('Вопросы и ответы').' '.$countQuestion;
$tabItem->active = $pathUrl === $tabItem->url;
$tabItems[] = $tabItem;

$tabItem = new TabItem();
$tabItem->url = '/shop/user/product-market/map.aspx?id=' . $product_id;
$tabItem->title = Az::l('Карта');
$tabItem->active = $pathUrl === $tabItem->url;
$tabItems[] = $tabItem;

$tabItem = new TabItem();
$tabItem->url = '/shop/user/product-market/monitoring.aspx?id=' . $product_id;
$tabItem->title = Az::l('Мониторинг');
$tabItem->active = $pathUrl === $tabItem->url;
$tabItems[] = $tabItem;

  

?>


<div class="classic-tab">
    <ul class="nav d-flex text-center justify-content-between" role="tablist">
        <?php foreach ($tabItems as $tabItem) : ?>

            <li class="nav-item border  px-0 col-sm">
                <a class="nav-link waves-light text-muted w-100 fp-17 show <?= $tabItem->active ? 'active' : '' ?>"
                   id="href-<?= $tabItem->id ?>"
                   href="<?= $tabItem->url ?>"
                >
                    <?= $tabItem->title ?>
                </a>
            </li>

        <?php endforeach; ?>
    </ul>
</div>

<style>
    .active {
        border-bottom: 3px solid limegreen !important;
    }
</style>
