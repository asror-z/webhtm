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

$companyId = $this->httpGet('id');



$urlId = null;
if (!empty($companyId))
    $urlId = "?id=$companyId";


// todo: test
$countReview = 4;
$countQuestion = 3;


$pathUrl = '/' . Az::$app->request->pathInfo . '?' . Az::$app->request->queryString;

$tabItems = [];
$tabItem = new TabItem();
$tabItem->url = '/shop/user/company/information.aspx' . $urlId;
$tabItem->title = Az::l('Информация');
$tabItem->active = $pathUrl === $tabItem->url;
$tabItems[] = $tabItem;

$tabItem = new TabItem();
$tabItem->url = '/shop/user/product/characteristics.aspx' . $urlId;
$tabItem->title = Az::l('Политика');
$tabItem->active = $pathUrl === $tabItem->url;
$tabItems[] = $tabItem;

$tabItem = new TabItem();
$tabItem->url = '/shop/user/product/price.aspx' . $urlId;
$tabItem->title = Az::l('Продукты');
$tabItem->active = $pathUrl === $tabItem->url;
$tabItems[] = $tabItem;

$tabItem = new TabItem();
$tabItem->url = '/shop/user/product/review.aspx' . $urlId;
$tabItem->title = Az::l('Отзывы') . " " . $countReview . "";
$tabItem->active = $pathUrl === $tabItem->url;
$tabItems[] = $tabItem;

$tabItem = new TabItem();
$tabItem->url = '/shop/user/product/questions-answers.aspx' . $urlId;
$tabItem->title = Az::l('Вопросы и ответы') . " " . $countQuestion . " ";
$tabItem->active = $pathUrl === $tabItem->url;
$tabItems[] = $tabItem;


?>


<div>

    ID is Required

</div>

