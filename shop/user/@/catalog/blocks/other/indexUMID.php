<section class="menu ml-3">
    <div class="row mt-2">
        <div class="col-xl-3">
            <?
            echo zetsoft\widgets\market\ZMenuWidget::widget([
                'config' => [
                    'open' => false,
                    // 'name' => 'Категории',
                    'mode' => 'shop'
                ],
            ]);

            ?>
        </div>
        <div class="col-xl-9">
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
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="row">
                <div class="col-md-12">
                    <div class="container-fluid">
                        <?
                        $category_id = $this->httpGet('id');
                        if (isset($category_id))
                            echo MenuItemWidget::widget([
                                'config' => [
                                    'menuItem' => Az::$app->market->category->getMenuItem($category_id)
                                ]
                            ]);
                        ?>
                        <?php
                        /** @var ZView $this */

                        $active = new Ajaxer();
                        $active->id = 'activeFormCheck';
                        $active->showLabels = false;

                        $form = $this->ajaxBegin($active);
                        $model = Az::$app->market->product->filterFormItems($this->httpGet('id') ?? null);
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
                                e.preventDefault();    
                             $('#sendValues').click();
                                //$.pjax.reload({container:'#activeFormCheck'});
                          }
JS

                            ]
                        ]);
                        ?>
                    </div>
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <?php

                            echo ZButtonWidget::widget([
                                'config' => [
                                    'text' => Az::l('Сбросить все'),
                                    'btnType' => ZButtonWidget::btnType['link'],
                                    'btnSize' => ZColor::btnSize['btn-md'],
                                    'btnRounded' => false,
                                    'class' => 'text-center',
                                    'btnStyle' => ZButtonWidget::btnStyle['btn-success'],
                                    'url' => '/core/product/clearFilterFromSession.aspx',
                                ]
                            ]);

                            $this->ajaxEnd();

                            ?>

                        </div>
                    </div>

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
            <div id="contento" class="row w-100">
                <?
                $category_id = $this->httpGet('id');
                $products = Az::$app->market->product->allProducts($category_id ?? null);
                foreach ($products as $item) {
                    echo $this->require( '/render/cards/ZVMarketWidget/ready/main.php', [
                        'item' => $item,
                        'col' => 4
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


<?php $this->endBody() ?>

</body>
</html>

<?php
$this->endPage()
?>
