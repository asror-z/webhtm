<?php

use yii\widgets\Pjax;
use zetsoft\dbitem\core\WebItem;
use zetsoft\models\shop\ShopOrder;
use zetsoft\models\shop\ShopProduct;
use zetsoft\models\user\User;
use zetsoft\service\forms\Active;
use zetsoft\service\forms\Ajaxer;
use zetsoft\service\forms\ZPjax;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\former\ZListViewWidget;
use zetsoft\widgets\inputes\ZKRangeWidget;
use zetsoft\widgets\menus\ZMetisMenuWidget;
use zetsoft\widgets\market\ZMenuWidget;
use zetsoft\widgets\menus\ZSidebarWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\navigat\ZSlimScrollWidget;

/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Категория';
$action->icon = 'fa fa-area-chart';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;



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


    echo ZSidebarWidget::widget();

    $this->head();

    ?>

</head>
<body class="<?= ZWidget::skin['white-skin'] ?>">
<?php

$this->beginBody();
?>
<section class="menu mx-2">
    <div class="row my-5">
        <!--ZMenuWidgetStart-->


        <div class="col-md-3">

            <div class="row">
                <div class="w-100 ml-3">
                    <?
                    echo ZMenuWidget::widget([
                        'name' => '123',
                        'config' => [
                            'open' => true,
                            'name' => 'Категории',
                        ],
                    ]);
                    ?>
                </div>
                <br><br><br><br>
                <? ZSlimScrollWidget::begin([
                    'config' => [
                        'begin' => true,
                        'width' => '100%',
                        'height' => '80vh',
                        'start' => ZSlimScrollWidget::start['top'],
                        'color' => '#10b410',
                        'alwaysVisible' => false,
                    ]
                ]) ?>
                <div class="col-md-12">
                    <div class="clear-session-button mb-3 d-flex justify-content-end">
                        <?
                        echo ZButtonWidget::widget([
                            'config' => [
                                'text' => Az::l('Clear Session'),
                                'btnType' => ZButtonWidget::btnType['link'],
                                'btnStyle' => ZButtonWidget::btnStyle['btn-outline-success'],
                                'url' => '/core/product/clearFilterFromSession.aspx',
                                'hasIcon' => true,
                                'icon' => 'fa fa-trash-alt mr-2',
                                'class' => 'mr-2'
                            ]
                        ]);
                        ?>
                    </div>
                    <?
                    /** @var ZView $this */
                    $active = new Ajaxer();
                    $active->id = 'activeFormCheck';
                    $active->showLabels = true;

                    $form = $this->ajaxBegin($active);
                    $model = Az::$app->market->product->filterFormItems($this->httpGet('id') ?? null);

                    //$model = new User();
                    echo ZFormWidget::widget([
                        'model' => $model,
                        'form' => $form,
                        'config' => [
                            'grapes' => false,

                            'topBtn' => false,
                            'botBtn' => false,
                        ],
                        'event' => [
                            'formChange' => <<<JS
                                function (event) {
                             $('#sendValues').click();
                                //$.pjax.reload({container:'#activeFormCheck'});
                          }
JS

                        ]
                    ]);


                    $this->ajaxEnd();

                    ?>

                </div>
            </div>


            <?

            echo ZButtonWidget::widget([
                'id' => 'sendValues',
                'config' => [
                    'text' => 'send form',
                    'btnType' => ZButtonWidget::btnType['button'],
                ]
            ]);
            ZSlimScrollWidget::end()
            ?>
        </div>

        <div class="col-md-9 ">

            <?php
            Pjax::begin();
            ?>
            <br>
            <div id="contento" class="mb-3">
                <?
                $category_id = $this->httpGet('id');
                $products = Az::$app->market->product->allProducts($category_id ?? null);
                foreach ($products as $item) {
                    echo $this->require( '/render/cards/ZVMarketWidget/ready/main.php', [
                        'item' => $item
                    ]);
                }


                /* echo ZListViewWidget::widget([
                     'model' => $this->model,
                     'data' => $this->data,
                     'config' => [
                         'itemView' => function ($model, $key, $index, $widget) {
                             //    $this->require(R)
                         },


                         'layout' => '{items}',
                         'pageSize' => 10,

                         //'sorter' => $sorter,
                         'sort' => $sort
                     ]
                 ]);*/


                //                echo \zetsoft\widgets\market\ZProductTabsOnlyWidget::widget([
                //                    'model' => Az::$app->market->product->allProducts($this->httpGET('id')),
                //                    'config' => [
                //                        'widget' => zetsoft\widgets\market\ZProductCardWidget::class,
                //                    ]
                //                ]);

                /* $sort=$this->httpGet('name');
                 $sort= (int)$sort;*/
                //vdd(Az::$app->market->product->allProducts($this->httpGet('id') ?? null));
                //if ($sort!=4 || $sort!=3)$sort=4;
                /* echo zetsoft\widgets\market\ZProductTabsOnlyWidget::widget(['model' => Az::$app->market->product->allProducts($this->httpGet('id') ?? null),
                     'config' => [
                         'sort'=>$sort,
                         'pager'=>zetsoft\widgets\market\ZProductTabsOnlyWidget::type['link'],
                         'widget' => zetsoft\widgets\market\ZProductCardWidget::class,

                     ]]);*/


                ?>


            </div>
            <?php Pjax::end(); ?>
        </div>
    </div>
</section>
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

    li:last-child {
        text-decoration: none !important;
    }

    #sendValues {
        visibility: hidden;
    }

    .partners {
        text-align: center;
        font-size: 30px;
        font-weight: bold;
        color: #10b410;
    }

    .topNavbarIcons i {
        font-size: 26px;
        color: #505050;
        padding-bottom: 5px;
    }

</style>
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

<?php $this->endPage() ?>
