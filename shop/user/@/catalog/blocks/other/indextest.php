<?php

use zetsoft\service\forms\Active;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\inputes\ZKRangeWidget;
use zetsoft\widgets\menus\ZMetisMenuWidget;
use zetsoft\widgets\market\ZMenuWidget;
use zetsoft\widgets\navigat\ZButtonWidget;


$this->title = Az::l('Market Place');
$action->icon = 'fa fa-rocket';
Az::$app->controller->layout = 'main';


?>
<section class="menu px-5 mx-5">
    <div class="row">

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
                    /** @var ZView $this */

                    $active = new Active();
                    $active->id = 'activeFormCheck';
                    $active->showLabels = false;

                    $form = $this->activeBegin($active);
                    $model = Az::$app->market->product->filterFormItems2($this->httpGet('id'));

                    echo ZFormWidget::widget([
                        'model' => $model,
                        'form' => $form,
                        'config' => [
                            'grapes' => false,

                            'topBtn' => false,
                            'botBtn' => false,
                        ]
                    ]);

                    $this->activeEnd();

                    $active = new Active();
                    $active->id = 'activeFormCheck';
                    $active->showLabels = false;

                    $form = $this->activeBegin($active);

                    $model = Az::$app->market->product->filterFormItems3($this->httpGet('id'));
                    $form = $this->activeBegin($active);

                    echo ZFormWidget::widget([
                        'model' => $model,
                        'form' => $form,
                        'config' => [
                            'grapes' => false,

                            'topBtn' => false,
                            'botBtn' => false,
                        ]
                    ]);

                    echo ZButtonWidget::widget([
                        'id' => 'sendValues',
                        'config' => [
                            'text' => 'send form',
                            'btnType' => ZButtonWidget::btnType['button'],
                        ]
                    ]);

                    echo ZButtonWidget::widget([
                        'config' => [
                            'text' => Az::l('Clear Session'),
                            'btnType' => ZButtonWidget::btnType['link'],
                            'url' => '/core/product/clearFilterFromSession.aspx',

                        ]
                    ]);

                    $this->activeEnd();
                    ?>

                </div>
            </div>

        </div>
        <div class="col-md-9 ">
            <?

            ?>
            <br>
            <div id="contento" class="mb-3">
                <?
                $this->pjaxBegin();
                echo \zetsoft\widgets\market\ZDilshodBoxWidget::widget([
                    'model' => Az::$app->market->product->allProducts($this->httpGET('id')),
                    'config' => [
                        'widget' => zetsoft\widgets\market\ZProductCardWidget::class,
                    ]
                ]);
                $this->pjaxEnd();
                ?>
            </div>
        </div>
    </div>
</section>

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



