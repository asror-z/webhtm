<?php

/**
 * @author: AzimjonToirov
 * Yandex tab yozdim Tab
 */

use zetsoft\dbitem\data\TabItem;
use zetsoft\models\shop\ShopQuestion;
use zetsoft\models\shop\ShopReview;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
  
$product_id = $this->httpGet('id');
$url = $this->httpGet();

$path = implode('&', array_map(
    function ($v, $k) { return sprintf("%s=%s", $k, $v); },
    $url,
    array_keys($url)
));
$type='product';
$countQuestion = Az::$app->market->question->countQuestionsById($product_id,$type);

$countReview = Az::$app->market->question->countReviewsById($product_id,$type);


$pathUrl = '/' . Az::$app->request->pathInfo . '?' . Az::$app->request->queryString;

$tabItems = [];
$tabItem = new TabItem();
$tabItem->url = '/shop/user/product-single/common.aspx?' . $path;
$tabItem->title = Az::l('Описание');
$tabItem->id = 'common';
$tabItem->active = $pathUrl === $tabItem->url;
$tabItems[] = $tabItem;

$tabItem = new TabItem();
$tabItem->id = 'characteristics';
$tabItem->url = '/shop/user/product-single/characteristics.aspx?'.$path;
$tabItem->title = Az::l('Характеристика');
$tabItem->active = $pathUrl === $tabItem->url;
$tabItems[] = $tabItem;

$tabItem = new TabItem();
$tabItem->id = 'information';
$tabItem->url = '/shop/user/product-single/information.aspx?'.$path;
$tabItem->title = Az::l('Информация');
$tabItem->active = $pathUrl === $tabItem->url;
$tabItems[] = $tabItem;

$tabItem = new TabItem();
$tabItem->id = 'price';
$tabItem->url = '/shop/user/product-single/price.aspx?' . $path;
$tabItem->title = Az::l('Цены');
$tabItem->active = $pathUrl === $tabItem->url;
$tabItems[] = $tabItem;

$tabItem = new TabItem();
$tabItem->id = 'review';
$tabItem->url = '/shop/user/product-single/review.aspx?' . $path;
$tabItem->title = Az::l('Отзывы').' '. $countReview;
$tabItem->active = $pathUrl === $tabItem->url;
$tabItems[] = $tabItem;

$tabItem = new TabItem();
$tabItem->id = 'questions-answers';
$tabItem->url = '/shop/user/product-single/questions-answers.aspx?' . $path;
$tabItem->title = Az::l('Вопросы и ответы').' '. $countQuestion;
$tabItem->active = $pathUrl === $tabItem->url;
$tabItems[] = $tabItem;

$tabItem = new TabItem();
$tabItem->id = 'map';
$tabItem->url = '/shop/user/product-single/map.aspx?' . $path;
$tabItem->title = Az::l('Карта');
$tabItem->active = $pathUrl === $tabItem->url;
$tabItems[] = $tabItem;

require Root . '/render/menus/ZSidebarWidget/ready/main.php';
?>


<div class="classic-tab">
    <ul class="nav d-flex text-center justify-content-between" role="tablist">
        <?php foreach ($tabItems as $tabItem) : ?>

            <li class="nav-item border  px-0 col-sm">
                <a class="nav-link zLoader waves-light text-muted w-100 h-100 fp-17 show <?= $tabItem->active ? 'active' : '' ?> hrefspage"
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
