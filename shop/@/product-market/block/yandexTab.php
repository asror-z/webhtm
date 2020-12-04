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
$countReview = ShopReview::find()->count();
$countQuestion= ShopQuestion::find()->where([
    'type' => 'question'
])->count();
//$countPrice = 

$pathUrl = '/' . Az::$app->request->pathInfo . '?' . Az::$app->request->queryString;

$tabItems = [];
$tabItem = new TabItem();
$tabItem->url = '/shop/user/product/common.aspx?id=' . $product_id;
$tabItem->title = Az::l('Описание');
$tabItem->active = $pathUrl === $tabItem->url;
$tabItems[] = $tabItem;

$tabItem = new TabItem();
$tabItem->url = '/shop/user/product/characteristics.aspx?id=' . $product_id;
$tabItem->title = Az::l('Характеристика');
$tabItem->active = $pathUrl === $tabItem->url;
$tabItems[] = $tabItem;

$tabItem = new TabItem();
$tabItem->url = '/shop/user/product/price.aspx?id=' . $product_id;
$tabItem->title = Az::l('Цены');
$tabItem->active = $pathUrl === $tabItem->url;
$tabItems[] = $tabItem;

$tabItem = new TabItem();
$tabItem->url = '/shop/user/product/review.aspx?id=' . $product_id;
$tabItem->title = Az::l('Отзывы')."(".$countReview.")";
$tabItem->active = $pathUrl === $tabItem->url;
$tabItems[] = $tabItem;

$tabItem = new TabItem();
$tabItem->url = '/shop/user/product/questions-answers.aspx?id=' . $product_id;
$tabItem->title = Az::l('Вопросы и ответы')."(".$countQuestion.")";
$tabItem->active = $pathUrl === $tabItem->url;
$tabItems[] = $tabItem;

$tabItem = new TabItem();
$tabItem->url = '/shop/user/product/map.aspx?id=' . $product_id;
$tabItem->title = Az::l('Карта');
$tabItem->active = $pathUrl === $tabItem->url;
$tabItems[] = $tabItem;


?>


<div class="classic-tab px-2">
    <ul class="nav d-flex text-center justify-content-between" role="tablist">
        <?php foreach ($tabItems as $tabItem) : ?>

            <li class="nav-item border px-0 col-sm ">
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
