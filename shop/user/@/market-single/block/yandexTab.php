<?php
/**
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 */

use zetsoft\dbitem\data\TabItem;
use zetsoft\models\shop\ShopOrder;
use zetsoft\models\shop\ShopProduct;
use zetsoft\system\Az;
use zetsoft\widgets\former\ZDynaWidget;

$company_id = $this->httpGet('id');


$urlId = null;
if (!empty($company_id))
    $urlId = "?id=$company_id";
$type = "company";

// todo: test
$countQuestion = Az::$app->market->question->countQuestionsById($company_id, $type);
$countReview = Az::$app->market->question->countReviewsById($company_id, $type);

$pathUrl = '/' . Az::$app->request->pathInfo . '?' . Az::$app->request->queryString;

$tabItems = [];

$tabItem = new TabItem();
$tabItem->url = '/shop/user/market-single/products.aspx' . $urlId;
$tabItem->title = Az::l('Продукты');
$tabItem->active = $pathUrl === $tabItem->url;
$tabItems[] = $tabItem;


$tabItem = new TabItem();
$tabItem->url = '/shop/user/market-single/politika.aspx' . $urlId;
$tabItem->title = Az::l('Политика');
$tabItem->active = $pathUrl === $tabItem->url;
$tabItems[] = $tabItem;


$tabItem = new TabItem();
$tabItem->url = '/shop/user/market-single/information.aspx' . $urlId;
$tabItem->title = Az::l('Информация');
$tabItem->active = $pathUrl === $tabItem->url;
$tabItems[] = $tabItem;

$tabItem = new TabItem();
$tabItem->url = '/shop/user/market-single/reviews.aspx?id=' . $company_id;
$tabItem->title = Az::l('Отзывы') . " " . $countReview . "";
$tabItem->active = $pathUrl === $tabItem->url;
$tabItems[] = $tabItem;

$tabItem = new TabItem();
$tabItem->url = '/shop/user/market-single/questions.aspx?id=' . $company_id;
$tabItem->title = Az::l('Вопросы и ответы') . " " . $countQuestion . " ";
$tabItem->active = $pathUrl === $tabItem->url;
$tabItems[] = $tabItem;


require Root . '/render/menus/ZSidebarWidget/ready/main.php';

?>


<div class="classic-tab">
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




