<?php

/**
 *
 * @license JaloliddinovSalohiddin
 * @license OtabekNosirov
 * @license AkromovAzizjon
 */

use Illuminate\Support\Collection;
use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\shop\ProductItem;
use zetsoft\models\shop\ShopOffer;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZInfinityScrollAjaxWidget;
use zetsoft\widgets\market\ZFooterAllWidget;
use zetsoft\widgets\market\ZFooterAllWidgetOrg;
use zetsoft\widgets\navigat\ZBreadcrumbsWidget;
use zetsoft\widgets\notifier\ZJspanelWidget;
use zetsoft\widgets\notifier\ZKGrowlWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;


/** @var ZView $this */

$market_id = $this->httpGet('id');

$products = Az::$app->market->product->allProducts(null, $market_id, 0, 10);

$companylist = Az::$app->market->product->allCompanies();

$catalogsByStatusSale = Az::$app->market->offer->catalogByStatus('discount', $market_id, 12);

$catalogsByStatusPopular = Az::$app->market->offer->catalogByStatus('popular', $market_id, 12);

$catalogsByStatusNew = Az::$app->market->offer->catalogByStatus('new', $market_id, 12);

foreach ($companylist as $item) {
    if ($item->id === (int)$market_id)
        $company = $item;
}

$action = new WebItem();

if (!empty($market_id) && !empty($company)) {
    $action->title = Azl . $company->name;
}
$action->icon = 'fa fa-area-chart';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;
$action->loader = true;

$action->cache = false;

$action->call = [];

$action->cacheHttp = false;

$this->paramSet(paramAction, $action);


if (!isset($products)) {

    $item = new ProductItem();
    $item->id = 2;
    $item->name = 'Арахисовая паста с медом 200г';
    $item->title = 'Test Desc';
    $item->new_price = '14825920';
    $item->price_old = '188920';
    $item->barcode = '34234234';
    $item->exist = ProductItem::exists['not'];
    $item->images = [
        'https://images.pexels.com/photos/1095550/pexels-photo-1095550.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500',
        'https://images.pexels.com/photos/461198/pexels-photo-461198.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500',
        'https://previews.123rf.com/images/veneratio/veneratio1511/veneratio151100044/48203428-landscape-iamge-of-river-flowing-through-lush-green-forest-in-summer.jpg',
        'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcRVDh2D2fzRSBYnwaA-70G74wjOeeZWbRnEVBMxfu1jVqcP9fMv&usqp=CAU',
    ];
    $item->currency = 'сум';
    $item->currencyType = 'after';
    $item->measure = 'шт';
    $item->rating = 3.5;
    $item->discount = -10;
    $item->catalogId = 19;
    $item->max_price = 2155632;
    $item->sale = 'sdadsa';
    $item->is_multi = false;
    $item->min_price = 'adssad';
    $item->in_wish = true;
    $item->in_compare = false;
    $item->cart_amount = 3;
    $item->status = [
        'sale'
    ];
    $item->url = '/shop/user/product-single/common.aspx?id=';
    $products[] = $item;
    $products[] = $item;
    $products[] = $item;
    $products[] = $item;
    $products[] = $item;
    $products[] = $item;
}

$this->title();
$this->toolbar();

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
<body class="<?= ZWidget::skin['white-skin'] ?> main-catalog-style">

<?php

$this->beginBody();
require Root . '/webhtm/block/header/mainM.php';
require Root . '/webhtm/block/navbar/main.php';

?>


<div class="container-fluid bg-white">
    <?
    if (empty($market_id) || empty($company)) :
        echo $this->require( '/render/market/NotFound/main.php', [
            'item' => 'К сожалению, данные отсутствуют.'
        ]);

    else :
    ?>
  <div class="row my-4">
    <div class="col-12 d-flex justify-content-around">

      <div class="d-flex align-items-center">
        <img width="100" height="100" class="mr-3 img-fluid img-primary"
             src="<?= '/imagez/mplace/' . ZArrayHelper::getValue($company->photo, 0)
             ?>" alt="">
        <span class="fp-26 font-weight-bold">
                    <?= $company->name ?>
                </span>
      </div>
      <div class="fp-20 w-75 ml-auto d-flex align-items-center">
          <?

          ZBreadcrumbsWidget::begin([
              'config' => [
                  'begin' => true,
                  'mode' => ZBreadcrumbsWidget::mode['page'],
              ]
          ]);

          $offers = new ShopOffer();
          foreach ($offers->_type as $offer) :?>

            <li class="mr-3">
              <a
                class="fp-20 hvr-underline-from-center"
                href="#"
                id="mainTo"
              >
                  <?= $offer ?>
              </a>
            </li>

          <? endforeach ?>

        <li class="">
          <a
            class="fp-20 hvr-underline-from-left"
            href="<?= ZUrl::to(['user/main-catalog/information', 'market_id' => $market_id]) ?>"
          >
              <?= Az::l('Информация') ?>
          </a>
        </li>

          <? ZBreadcrumbsWidget::end(); ?>

      </div>
    </div>
  </div>
</div>

  <div class="container-fluid p-0">

    <div class="container-fluid">
      <div class="row">

        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-12 mt-3">
            <?
            echo zetsoft\widgets\market\ZMenuWidget::widget([
                'config' => [
                    'open' => true,
                    'mode' => 'shop',
                    'company_id' => $market_id

                ],
            ]);
            ?>
        </div>

        <!--<div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 p-gfh">
            <?/*= $this->require( '/webhtm/shop/user/main-common/block/swiper.php', [
                'market_id' => $market_id
            ]) */?>
        </div>-->

      </div>
    </div>

    <div class="container-fluid">
      <div class="row mb-5" id="products">
        <div class="mx-auto mt-3">
          <h3 class="">ВЫБРАНО ДЛЯ ВАС</h3>
        </div>
        <div class="col-md-12">
            <?
            echo $this->require( '/webhtm/shop/user/main-common/block/swiperNumberOne.php');
            ?>
        </div>
      </div>

      <div class="row mt-4" id="new">
        <div class="col-12">
          <a class="fp-28"
             href="<?= ZUrl::to(['user/main-catalog/new', 'market_id' => $market_id]) ?>"><?= Az::l('Новинки') ?>
            <span class="ml-2 badge badge-success shadow-none fe-05">Новый</span>
          </a>
        </div>
        <div class="col-12">
          <div class="row">
              <?
              /** @var Collection $catalogsByStatusNew */


              if ($catalogsByStatusNew->count() === 0) {

                  echo $this->require( '/webhtm/shop/user/main-common/empty/emptyBySatus.php');
              } else {
                  foreach ($catalogsByStatusNew as $product) {

                      echo $this->require( '/render/cards/ZVMarketWidget/ready/main_row2.php', [
                          'item' => $product,
                          'id' => random_int(1, 1000000)
                      ]);
                  }
              }
              ?>
          </div>
        </div>
      </div>

      <div class="row mt-4" id="sale">
        <div class="col-12">
          <a class="fp-28" href="<?= ZUrl::to(['user/main-catalog/sale', 'market_id' => $market_id]) ?>">
              <?= Az::l('Cкидки') ?>
            <span class="ml-4 badge badge-danger shadow-none fe-05">Sale<i class="fas fa-percent fp-12"></i></span>
          </a>
        </div>
        <div class="col-12">
          <div class="row">
              <?

              if ($catalogsByStatusSale->count() === 0) {

                  echo $this->require( '/webhtm/shop/user/main-common/empty/emptyBySatus.php');
              } else {
                  foreach ($catalogsByStatusSale as $product) {
                      echo $this->require( '/render/cards/ZVMarketWidget/ready/main_row2.php', [
                          'item' => $product,
                          'id' => random_int(1, 1000000)
                      ]);
                  }
              }
              ?>
          </div>
        </div>
      </div>
      <div class="row mt-4" id="popular">
        <div class="col-12">
          <h3><?= Az::l('Популярное') ?></h3>
        </div>
        <div class="col-12">
          <div class="row">
              <?
              if ($catalogsByStatusPopular->count() === 0) {
                  echo $this->require( '/webhtm/shop/user/main-common/empty/emptyBySatus.php');
              } else {
                  foreach ($catalogsByStatusPopular as $product) {
                      echo $this->require( '/render/cards/ZVMarketWidget/ready/main_row2.php', [
                          'item' => $product,
                          'id' => random_int(1, 1000000)
                      ]);
                  }
              }
              ?>
          </div>
        </div>
      </div>
    </div>
  </div>


<? endif ?>

<?php
echo ZFooterAllWidgetOrg::widget();
echo ZJspanelWidget::widget([]);
?>
<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
