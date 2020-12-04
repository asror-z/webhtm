<?php

use yii\widgets\Pjax;
use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\shop\ProductItem;
use zetsoft\former\shop\ShopProductItemForm;
use zetsoft\models\shop\ShopCategory;
use zetsoft\service\forms\Active;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZInfinityScrollAjaxWidget;
use zetsoft\widgets\cards\ZMyCardWidget;
use zetsoft\widgets\cards\ZProductCardWidget;
use zetsoft\widgets\cards\ZProductTabsOnlyWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\inputes\ZKRangeWidget;
use zetsoft\widgets\market\ZCompareJobirWidget;
use zetsoft\widgets\market\ZFooterAllWidget;
use zetsoft\widgets\market\ZFooterAllWidgetOrg;
use zetsoft\widgets\market\ZMegaMenuWidget;
use zetsoft\widgets\market\ZMenuWidget;
use zetsoft\widgets\menus\ZMenuItemWidget;
use zetsoft\widgets\menus\ZMetisMenuWidget;
use zetsoft\widgets\menus\ZSidebarWidget;
use zetsoft\widgets\navigat\ZBreadcrumbsWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\navigat\ZReadMoreWidget;


/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . Az::l('Недавно просмотренные');
$action->icon = 'fa fa-area-chart';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = false;



$this->paramSet(paramAction, $action);

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
<body class="<?= ZWidget::skin['white-skin'] ?>">
<?php

$this->beginBody();

require Root . '/webhtm/block/header/mainM.php';
require Root . '/webhtm/block/navbar/main.php';
require Root . '/render/menus/ZSidebarWidget/ready/main.php';

$parent = ShopCategory::findOne(26);
$item = Az::$app->market->category->getItems($parent);
?>

<div id="content">


    <div class="row m-3">
        <div class="col-12 mt-3">
            <div class="row">
                <div class="col-md-12">
<!--                    --><?//
//                        echo $this->require('/render/cards/ZListViewWidget/ready/tab_product.php');
//                    ?>
                </div>
            </div>
            <div class="row">
                <?php
                /**@var ZView $this */

                $items = Az::$app->market->session->getViewedProductItems();
                /* vdd($items);*/
                /*if (empty($items)) {
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
                }*/


                if (!empty($items)) {
                    foreach ($items as $item) {
                        echo $this->require( '/render/cards/ZListViewWidget/ready/vertical_horizontal_infinity.php', [
                            'id' => $item->id,
                            'item' => $item,
                            'col'=>3
                        ]);
                    }
                }
                ?>
            </div>
            <div class="row">
                <div class="col-12">
                    <?

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
                    if (empty($items)) {
                        ?>
                        <div class="my-5">
                            <div class="text-center d-block">
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
                                        'url' => '/shop/user/main/main.aspx',
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
                <div id="contento" class="my-3 mx-auto">
                    <?
                    //Pjax::begin();
                    if ($this->sessionGet('viewed')) {
                        echo ZButtonWidget::widget([
                            'config' => [
                                'btnStyle' => ZButtonWidget::btnStyle['btn-success'],
                                'btnRounded' => false,
                                'text' => Az::l('Очистить список'),
                                'url' => '/core/product/clearViewedSession.aspx'
                            ],
                        ]);
                    }
                    //vdd($this->sessionGet('viewed'));
                    //Pjax::end();
                    ?>
                </div>
            </div>
        </div>
    </div>


</div>

<?php
echo ZFooterAllWidgetOrg::widget([]);
?>



<!--<script>
    let lS = window.localStorage;
    let zcol = $('.zcol');
    let zlist = $('.zlist');
    let items = $('.appendTo .zcol,.appendTo .zlist');
    zlist.hide();

    $(document).on('ready pjax:success', function () {
        lS = window.localStorage;
        zcol = $('.zcol');
        zlist = $('.zlist');
        items = $('.appendTo .zcol,.appendTo .zlist');
        zlist.hide();

        function switchToCol() {
            zcol.hide();
            zlist.show();
            $('#switch_to_list').addClass('text-success')
            $('#switch_to_list').removeClass('btn-success')
            $('#switch_to_col').removeClass('text-success');
            $('#switch_to_col').addClass('btn-success');
        }

        function switchToList() {
            zcol.show();
            zlist.hide();
            $('#switch_to_col').addClass('text-success');
            $('#switch_to_col').removeClass('btn-success');
            $('#switch_to_list').removeClass('text-success');
            $('#switch_to_list').addClass('btn-success');
        }

        if (lS.getItem('grid') === 'switch_to_list') {
            switchToList();
        } else {
            switchToCol();
        }
        $('#switch_to_list, #switch_to_col').on('click', function () {
            lS.setItem('grid', $(this).attr('id'))
            console.log(lS.getItem('grid'), 'asdasdas')
            zcol = $('.zcol');
            zlist = $('.zlist');
            items = $('.appendTo .zcol,.appendTo .zlist');
            $(this).removeClass('text-success')
            $(this).addClass('btn-success')
            if ($(this).attr('id') === 'switch_to_list') {
                switchToList()
            }
            if ($(this).attr('id') === 'switch_to_col') {
                switchToCol();
            }
        })
    })

    function switchToCol() {
        zcol.hide();
        zlist.show();
        items.addClass('col-12');
        items.removeClass('col-3');
        $('#switch_to_list').addClass('text-success')
        $('#switch_to_list').removeClass('btn-success')
        $('#switch_to_col').removeClass('text-success');
        $('#switch_to_col').addClass('btn-success');
    }

    function switchToList() {
        zcol.show();
        zlist.hide();
        items.addClass('col-3');
        items.removeClass('col-12');
        $('#switch_to_col').addClass('text-success');
        $('#switch_to_col').removeClass('btn-success');
        $('#switch_to_list').removeClass('text-success');
        $('#switch_to_list').addClass('btn-success');

    }

    $('#switch_to_list, #switch_to_col').on('click', function () {
        lS.setItem('grid', $(this).attr('id'))
        zcol = $('.zcol');
        zlist = $('.zlist');
        items = $('.appendTo .zcol,.appendTo .zlist');
        $(this).removeClass('text-success')
        $(this).addClass('btn-success')
        if ($(this).attr('id') === 'switch_to_list') {
            switchToList()
        }
        if ($(this).attr('id') === 'switch_to_col') {
            switchToCol();
        }
    })

    function checkTabs() {
        lS = window.localStorage;
        items = $('.appendTo .zcol,.appendTo .zlist');
        zcol = $('.zcol');
        zlist = $('.zlist');
        if (lS.getItem('grid') === 'switch_to_list') {
            switchToList();
        } else {
            switchToCol();
        }
    }

    checkTabs();

</script>-->

<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
