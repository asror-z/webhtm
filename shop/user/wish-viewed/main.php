<?php

use yii\widgets\Pjax;
use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\shop\ProductItem;
use zetsoft\former\shop\ShopProductItemForm;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZInfinityScrollAjaxWidget;
use zetsoft\widgets\cards\ZMyCardWidget;
use zetsoft\widgets\cards\ZProductCardWidget;
use zetsoft\widgets\cards\ZProductTabsOnlyWidget;
use zetsoft\widgets\inputes\ZKRangeWidget;
use zetsoft\widgets\market\ZCompareJobirWidget;
use zetsoft\widgets\market\ZFooterAllWidget;
use zetsoft\widgets\market\ZMegaMenuWidget;
use zetsoft\widgets\market\ZMenuWidget;
use zetsoft\widgets\menus\ZMetisMenuWidget;
use zetsoft\widgets\menus\ZSidebarWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\places\ZGoogleNavigateWidget;
use zetsoft\widgets\places\ZGoogleReadyNavigationWidget;


/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . Az::l('Недавно просмотренные');
$action->icon = 'fa fa-area-chart';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;



$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

/** @var ZView $this */
$this->fileJs('/render/ajaxify/ZInfinityScrollAjaxWidget/asset/main.js');

$this->beginPage();

?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>

    <?php

    ZGoogleReadyNavigationWidget::widget([
        'data' => [
            3,
            5,
            4,
        ]
    ]);

    require Root . '/webhtm/block/metas/main.php';
    require Root . '/webhtm/block/assets/main.php';


    $this->head();

    ?>

</head>
<body class="<?= ZWidget::skin['white-skin'] ?>">
<?php

$this->beginBody();


require Root . '/webhtm/block/navbar/main.php';
require Root . '/render/menus/ZSidebarWidget/ready/main.php';

?>

<section id="content" class="menu">
    <div class="container">


        <div class="row ">
            <div class="col-12">
                <div class="col-md-12">
                    <?php
                    /**@var ZView $this */

                    $items = Az::$app->market->session->getViewedProductItems();
                    //vdd($items);

                    $products = null;
                    if (!isset($product)) {
                        $item = new \zetsoft\dbitem\shop\ProductItem();
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
                        $item->properties = [
                            (object)[
                                'name' => '182sad',
                                'branch' => '00421sa',
                                'property' => [
                                    'huihuih',
                                    'okjio',
                                    'juijiio'
                                ],
                            ],
                        ];
                        $item->allProperties = [
                            (object)[
                                'name' => '182sad',
                                'branch' => '00421sa',
                                'property' => [
                                    'huihuih',
                                    'okjio',
                                    'juijiio'
                                ],
                            ]
                        ];
                        $products[] = $item;
                    }

                    if (isset($products)) {
                        foreach ($products as $item) {
                            echo $this->require( '/render/cards/ZVMarketWidget/ready/main.php', [
                                'id' => $item->id,
                                'item' => $item,

                            ]);
                        }
                    }
                    ?>
                </div>

            </div>


        </div>

        <div class="row">
            <div class="col-12">
                <?
                //$products = Az::$app->market->product->getCompareProductItems();
                /** @var ZView $this */
                $baseUrl = $this->urlGetBase();
                if (false) {
                    echo ZCompareJobirWidget::widget([
                        'config' => [
                            'borderColor' => 'border-success',
                            'selectColor' => '#00c851',
                            'br-color' => '#00c851',
                        ]]);
                    //echo ZMyCardWidget::widget(['config' => []]);
                }
                if (false) {
                    ?>
                    <div class="my-5">
                        <div class="text-center d-block">

                            <!--<img width="200" class="img-fluid mx-auto d-block"
                                 src="/render/images/ZHImgWidget/demo/asset/shopping-cart.gif">-->
                            <i class="fas fa-history fa-10x text-light" aria-hidden="true"></i>


                            <h3 class="mt-5 text-muted">
                                <?= Az::l('Нет просмотренныx товаров') ?>
                            </h3>

                            <span class="mx-1 text-muted">
                                <?= Az::l('Отправляйтесь за покупками или авторизуйтесь чтобы увидеть уже просмотренные товары.') ?>
                             </span><br>
                            <br>
                            <?
                            echo ZButtonWidget::widget([
                                'config' => [
                                    'text' => 'Перейти к покупкам',
                                    'color' => ZColor::color['green'],
                                    'class' => 'ss',
                                    'url' => '/shop/user/main/index.aspx',
                                    'btnStyle' => ZButtonWidget::btnStyle['btn-success'],
                                    'btnSize' => ZColor::btnSize['btn-md'],
                                    'btnFontSize' => ZButtonWidget::btnScale['0.5'],
                                    'btnRounded' => false,
                                ],

                            ]); ?>
                        </div>
                    </div>
                    <?
                }
                ?>
            </div>
        </div>
        <div class="row">
            <div id="contento" class="mb-3">
                <?
                Pjax::begin();
                if ($this->sessionGet('viewed')) {
                    echo ZButtonWidget::widget([
                        'config' => [
                            'btnStyle' => ZButtonWidget::btnStyle['btn-success'],
                            'btnRounded' => false,
                            'text' => Az::l('Очистить список'),
                            'url' => '/core/product/clearViewedSession.aspx',
                        ],
                    ]);
                }
                Pjax::end();
                ?>
            </div>
        </div>
    </div>
</section>


<?php
echo ZFooterAllWidget::widget([]);
?>

<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
