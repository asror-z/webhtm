<?php

use yii\widgets\Pjax;
use zetsoft\dbitem\core\WebItem;
use zetsoft\service\forms\Ajaxer;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\shop\ShopCategory;





/**
 *
 * Action Params
 */
 
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



/**
 *
 * Start Page
 */

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

echo ZNProgressWidget::widget([]);

?>

<div id="page">

    <?

    echo ZSessionGrowlWidget::widget();?>

    <div id="content" class="content-footer p-3">

 

        <div class="row">
            <div class="col-md-12">

                <section class="menu px-5 mx-5">
                    <div class="row my-5">
                        <!--ZMenuWidgetStart-->
                        <div class="col-md-3">
                            <div class="row">
                                <div class="col-md-12">
                                    <?
                                    /*echo ZMenuWidget::widget([
                                        'name' => '123',
                                        'config' => [
                                            'open' => false,
                                            'name' => 'Категории',
                                        ],
                                    ]);*/
                                    ?>
                                </div>

                                <div class="col-md-12">
                                    <?php
                                    /* $pjax = new ZPjax();
                                     $pjax->id = 'form';
                                     $pjax->linkSelector = 'sendValues';

                                     $this->pjaxBegin($pjax);*/

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
                                function() {
                             $('#sendValues').click();
                             $.pjax.reload({container:'#formSub'});
                          }
JS

                                        ]
                                    ]);

                                    echo ZButtonWidget::widget([
                                        'config' => [
                                            'text' => Az::l('Clear Session'),
                                            'btnType' => ZButtonWidget::btnType['link'],
                                            'url' => '/core/product/clearFilterFromSession.aspx',
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
                            ?>
                        </div>
                        <div class="col-md-9 ">

                            <?php
                            Pjax::begin();
                            ?>
                            <br>
                            <div id="contento" class="mb-3">
                                <?

                                //                echo \zetsoft\widgets\market\ZProductTabsOnlyWidget::widget([
                                //                    'model' => Az::$app->market->product->allProducts($this->httpGET('id')),
                                //                    'config' => [
                                //                        'widget' => zetsoft\widgets\market\ZProductCardWidget::class,
                                //                    ]
                                //                ]);

                                $sort=$this->httpGet('name');
                                $sort= (int)$sort;
                                //vdd(Az::$app->market->product->allProducts($this->httpGet('id') ?? null));
                                if ($sort!=4 || $sort!=3)$sort=4;
                                /* echo zetsoft\widgets\market\ZProductTabsOnlyWidget::widget(['model' => Az::$app->market->product->allProducts($this->httpGet('id') ?? null),
                                     'config' => [
                                         'sort'=>$sort,
                                         'pager'=>zetsoft\widgets\market\ZProductTabsOnlyWidget::type['link'],
                                         'widget' => zetsoft\widgets\market\ZProductCardWidget::class,

                                     ]]);*/


                                ?>


                            </div>
                            <?php  Pjax::end();?>
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

            </div>
        </div>


    </div>

</div>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
