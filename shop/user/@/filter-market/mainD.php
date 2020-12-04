<?php

use yii\widgets\Pjax;
use zetsoft\dbitem\core\WebItem;
use zetsoft\models\shop\ShopOrder;
use zetsoft\models\shop\ShopProduct;
use zetsoft\models\user\User;
use zetsoft\service\forms\Active;
use zetsoft\service\forms\Ajaxer;
use zetsoft\service\forms\ZPjax;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZInfinityScrollAjaxWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\former\ZListViewWidget;
use zetsoft\widgets\inputes\ZKRangeWidget;
use zetsoft\widgets\menus\MenuItemWidget;
use zetsoft\widgets\menus\ZMetisMenuWidget;
use zetsoft\widgets\market\ZMenuWidget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\menus\ZSidebarWidget;
use zetsoft\widgets\navigat\ZBreadcrumbsWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\navigat\ZMarketDropdownWidget;
use zetsoft\widgets\navigat\ZMenu2Widget;
use zetsoft\widgets\navigat\ZReadMoreWidget;

/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Продукты по категориям';
$action->icon = 'fa fa-area-chart';
$action->type = WebItem::type['html'];
/*$action->csrf = true;
$action->debug = true;

*/


$marketId = $this->httpGet('marketId');
$categoryId = $this->httpGet('categoryId');
$this->paramSet(paramAction, $action);
$this->title();
$this->toolbar();
/** @var ZView $this */
$this->beginPage();
?>

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
require Root . '/render/menus/ZSidebarWidget/ready/main.php';
?>




<div class="container-fluid bg-white">
    <div class="row">
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12 media-category">
            <?


           /* echo ZMenuWidget::widget([
                'config' => [
                    'open' => true,
                    'mode' => 'shop'
                ],
            ]);*/
            ?>
            <div class="row mx-1">
                <!--<div class="col-12">
                    <?/*= $this->require( '/webhtm/shop/user/common-common/blocks/parent.php') */?>
                </div>-->
                <div class="col-12 px-0">
                    <br>
                    <?php
                    /** @var ZView $this */



                    $active = new Ajaxer();
                    $active->id = 'activeFormCheck';
                    $active->showLabels = false;

                    $form = $this->ajaxBegin($active);
                    $models = Az::$app->smart->widget->getFilterbrands();
                    //vdd($models);
                    /*$models =  [
                        'Особенности' => [],
                        'Тип продукта' => [],
                        'Дизайн' => [],
                    ];*/
                    foreach ($models as $title => $model) {
                        echo ZMarketDropdownWidget::widget([
                            'config' => [
                                'title' => $title,
                                'content' => ZFormWidget::widget([
                                    'model' => $model,
                                    'form' => $form,
                                    'config' => [
                                        'topBtn' => false,
                                        'botBtn' => false,
                                    ],
                                ]),
                            ],
                            'event' => [
                                'formChange' => <<<JS
                                function (event) {
                                e.preventDefault();    
                             $('#sendValues').click();
                                //$.pjax.reload({container:'#activeFormCheck'});
                          }
JS

                            ]
                        ]);

                    }
                    // echo $this->require( '/webhtm/shop/user/filter-market/blocks/html.php');

                    ?>
                </div>
                <div class="col-12 px-0">

                    <?php

                    echo ZButtonWidget::widget([
                        'config' => [
                            'text' => Az::l('Сбросить все'),
                            'btnType' => ZButtonWidget::btnType['link'],
                            'btnSize' => ZColor::btnSize['btn-md'],
                            'btnRounded' => false,
                            'class' => 'text-center btn-block',
                            'btnStyle' => ZButtonWidget::btnStyle['btn-success'],
                            'url' => '/core/product/clearFilterFromSession.aspx',
                        ]
                    ]);

                    $this->ajaxEnd();

                    ?>
                </div>
            </div>
            <?php

            echo ZButtonWidget::widget([
                'id' => 'sendValues',
                'config' => [
                    'text' => 'send form',
                    'btnType' => ZButtonWidget::btnType['button'],
                ]
            ]);
            ?>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-12 col-12">
            <?
            echo ZBreadcrumbsWidget::widget([
                'config' => [
                    //'mainUrl' => '/shop/user/product/single-productAzizjonSherzod2.php',
                    //'mode' => ZBreadcrumbsWidget::mode['category'],
                    //'category_id' => 1
                ]
            ]);


            ?>

            <div class="row">

                    <?

                    echo ZInfinityScrollAjaxWidget::widget([
                        'config' => [
                            'url' => 'infinity.aspx',
                            'requireUrl' => '/render/cards/ZVMarketWidget/ready/main.php',
                            'limit' => 6,
                            'cols' => 2,
                            'namespace'=>'market',
                            'service'=>'product',
                            'method'=>'allProducts',
                            'test' => false
                        ]
                    ]);
                    ?>
            </div>
        </div>
    </div>
    


</div>


<script>
    // var sortdata;
    // var category;
    // $('#sort-price').click(function(){
    function funprice() {
        /* switch ($(this).data("price")) {
             case 'asc':
                 sortdata = 3;
                 category = "desc";
                 break;
             case 'desc':
                 sortdata = 4;
                 category = "asc";
                 break;
             default:
                 sortdata = 0;
                 break;
         }*/
        /* $.ajax({
             url: '/core/product/sort.aspx',
             type: 'GET',
             data: {
                 name: sortdata,
                 cat: category
             },
             success: function (data) {
                 $('#contento').html(data);
                 $.pjax.reload({container: '#contento', timeout: false});

             },

         });*/
    }


    // });
</script>
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
<style>

    #sendValues {
        visibility: hidden;
    }

</style>
<script>
    $(function () {
        $('.inner-content-div').slimScroll({
            height: '250px'
        });
    });
</script>
<script>
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
        history.pushState("/core/tester/asror/main.aspx?path=webhtm/shop/market/main/list-view1.php", "", "#col");
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

</script>

<?php echo ZReadMoreWidget::widget([
    'config' => [
        'parentclass' => 'parrentbody',
        'itemInSummary' => 3,
        'itemClass' => 'es-selectable',
    ]
]);

echo ZReadMoreWidget::widget([

    'config' => [

        'itemInSummary' => 2,
        'parentclass' => 'accPanelBody',
        'itemClass' => 'optionCheckBoxes',
    ]
]);
echo ZReadMoreWidget::widget([

    'config' => [

        'itemInSummary' => 8,
        'parentclass' => 'menu-container',
        'itemClass' => 'mode',
    ]
]);
?>
<?php $this->endBody() ?>
<?=
$this->require( '/webhtm/block/SingleProduct/footer.php');
?>
</body>
</html>

<?php
$this->endPage()
?>
