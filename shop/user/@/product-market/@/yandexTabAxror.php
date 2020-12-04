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
/*if(!$review_type)
    $review_type = 'company';
$countReview = ShopReview::find()->where([
    'type' => $review_type
])->count();*/
//$countReview = 1;
$count = $this->httpGet('count');
$countQuestion= ShopQuestion::find()->where([
    'type' => 'question'
])->count();
//$countPrice =

$pathUrl = '/' . Az::$app->request->pathInfo . '?' . Az::$app->request->queryString;

$tabItems = [];
$tabItem = new TabItem();
$tabItem->url = '/shop/user/product-single/commonAxror.aspx?id=' . $product_id;
$tabItem->title = Az::l('Описание');
$tabItem->active = $pathUrl === $tabItem->url;
$tabItems[] = $tabItem;

$tabItem = new TabItem();
$tabItem->url = '/shop/user/product-single/characteristics.aspx?id=' . $product_id;
$tabItem->title = Az::l('Характеристика');
$tabItem->active = $pathUrl === $tabItem->url;
$tabItems[] = $tabItem;

$tabItem = new TabItem();
$tabItem->url = '/shop/user/product-single/price.aspx?id=' . $product_id;
$tabItem->title = Az::l('Цены');
$tabItem->active = $pathUrl === $tabItem->url;
$tabItems[] = $tabItem;

$tabItem = new TabItem();
$tabItem->url = '/shop/user/product-single/review.aspx?id=' . $product_id;
$tabItem->title = Az::l('Отзывы')." ".$count;
$tabItem->active = $pathUrl === $tabItem->url;
$tabItems[] = $tabItem;

$tabItem = new TabItem();
$tabItem->url = '/shop/user/product-single/questions-answers.aspx?id=' . $product_id;
$tabItem->title = Az::l('Вопросы и ответы')." ".$countQuestion;
$tabItem->active = $pathUrl === $tabItem->url;
$tabItems[] = $tabItem;

$tabItem = new TabItem();
$tabItem->url = '/shop/user/product-single/map.aspx?id=' . $product_id;
$tabItem->title = Az::l('Карта');
$tabItem->active = $pathUrl === $tabItem->url;
$tabItems[] = $tabItem;

$tabItem = new TabItem();
$tabItem->url = '/shop/user/product-single/monitoring.aspx?id=' . $product_id;
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
