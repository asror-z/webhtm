<?php

use yii\widgets\Pjax;
use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\wdg\MenuItem;
use zetsoft\models\shop\ShopOrder;
use zetsoft\models\shop\ShopProduct;
use zetsoft\models\user\User;
use zetsoft\service\forms\Active;
use zetsoft\service\forms\Ajaxer;
use zetsoft\service\forms\ZPjax;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZInfinityScrollAjaxWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\former\ZListViewWidget;
use zetsoft\widgets\inputes\ZKRangeWidget;
use zetsoft\widgets\menus\MenuItemWidget;
use zetsoft\widgets\menus\ZMetisMenuWidget;
use zetsoft\widgets\market\ZMenuWidget;
use zetsoft\widgets\menus\ZSidebarWidget;
use zetsoft\widgets\navigat\ZBreadcrumbsWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\navigat\ZReadMoreWidget;


/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Категория';
$action->icon = 'fa fa-area-chart';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;



//$items = Az::$app->market->category->generateDBMenuItems();

$items = [];

if (!isset($menuItems)){
    $menuItems = new MenuItem();
    
    $menuItems->location = "right";
    $menuItems->target = "_self";
    $menuItems->label = "noutbuki";
    $menuItems->tooltip = null;
    $menuItems->class = null;
    $menuItems->data = null;
    $menuItems->dataItem = null;
    $menuItems->url = '/shop/user/main-common/main.aspx?id=40';
    $menuItems->id = 40;
    $menuItems->param = null;
    $menuItems->visible = true;
    $menuItems->inline = false;
    $menuItems->items = [];
    $menuItems->extra = [];
    $menuItems->icon = "";
    $menuItems->image = "https://cdn.dribbble.com/users/357797/screenshots/3998541/empty_box.jpg";

    $items[] = $menuItems;

}

//vdd($items);

$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

/** @var ZView $this */
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
<body class="<?= ZWidget::skin['white-skin'] ?> borderzz">
<?php

$this->beginBody();
require Root . '/webhtm/block/header/main.php';
require Root . '/webhtm/block/navbar/main.php';
?>


<div class="container-fluid bg-white">
    <div class="row py-3">
        <div class="col-lg-3 col-4">
            <div class="row mx-1">
                <div class="col-12 border border-light rounded">
                    <h4>Смежные категории</h4>
                    <?
                    echo \zetsoft\widgets\menus\ZMetisMenuWidget::widget([
                        'config' => [
                            'MenuOpen' => true,
                            'type' => ZMetisMenuWidget::type['Category'],
                        ],
                    ]);
                    ?>
                </div>
                <div class="col-12">

                </div>
                <div class="col-12">
                </div>
            </div>
        </div>
        <div class="col-lg-9 col-8">
            <div class="row">
                <div class="col-12">
                    <?php
                    $category_id = $this->httpGet('id');
                    if (isset($category_id))
                        echo ZBreadcrumbsWidget::widget([
                            'config' => [
                                'mode' => ZBreadcrumbsWidget::mode['category'],
                                'category_id' => $category_id
                            ]
                        ]);
                    ?>
                </div>
                <div class="col-12">
                    <?php
                    Pjax::begin();
                    ?>
                    <h3>Основные Категории</h3>
                    <div id="contento" class="row w-100">
                        <?
                        $category_id = $this->httpGet('id');
                        foreach ($items as $item) {
                            echo $this->require( '/render/cards/ZVMarketWidget/ready/card.php', ['item' => $item]);

                        }

                        ?>
                    </div>
                    <h3>Категории</h3>
                    <div class="row">

                        <?php

                        $this->pjaxBegin();

                        use zetsoft\dbitem\shop\ProductItem;

                        /** @var ZView $this */
                        /*$model = Az::$app->market->product->allProducts();*/
                        $model=null;
                        if (!isset($model)) {
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

                            $model[]=$item;
                            /*$model[]=$item;
                            $model[]=$item;*/
                        }

                       /* echo ZInfinityScrollAjaxWidget::widget([
                            'config' => [
                                'requireUrl' => '/render/cards/ZVMarketWidget/ready/vmarket.php',
                                'limit' => 12,
                                'items' => $model,
                                'type' => 'ajax',
                                'url' => '/blocks/infinite/infinite_abl.aspx',
                            ]
                        ]);*/

                        $this->pjaxEnd();

                        ?>
                    </div>
                    <?php Pjax::end(); ?>
                </div>
            </div>
            <div class="row">

            </div>
        </div>
    </div>
</div>

<script>



    var wishes = document.querySelectorAll('.add_wish_list');
    wishes.forEach(function (item) {
        $(item).click(function () {
            let elem_icon = $(this);
            let data = elem_icon.data('elemid');


        })
    });


    $(document).on('change', 'form', function () {
        $('#sendValues').click();
    });
    //bu kerak Market blog uchun o`chirilmasin
    $(document).on('click', 'form', function () {
        $('#sendValues').click();
    });

    $('#sendValues').click(function () {

        $.ajax({
            type: 'POST',
            url: '/core/product/setFilter.aspx',
            data: $('#activeFormCheck').serialize(),
            success: function (response) {
                $('#contento').html(response);
                $.pjax.reload({container: '#form', timeout: false});
            },
        });


    });

</script>

<script>
    $(function () {
        $('.inner-content-div').slimScroll({
            height: '250px'
        });
    });
</script>

<?php $this->endBody() ?>

</body>
</html>

<?php
$this->endPage()
?>
