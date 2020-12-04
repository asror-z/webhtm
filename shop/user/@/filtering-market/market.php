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
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
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
use zetsoft\widgets\navigat\ZReadMoreWidget;

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
$marketId = $this->httpGet('marketId');


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
require Root . '/render/menus/ZSidebarWidget/ready/main.php';
?>


<div class="container-fluid bg-white">
    <div class="row py-3">
        <div class="col-md-3">
            <div class="row mx-1">

                <div class="col-12 border border-light rounded">

                    <?= $this->require( '/webhtm/shop/user/common-market/blocks/parent.php') ?>
                </div>

                <div class="col-12">
                    <br>
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
                <div class="col-12">

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
        <div class="col-9">
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
                    <div id="contento" class="row w-100">
                        <?
                        $category_id = $this->httpGet('id');
                        $products = Az::$app->market->product->allProducts($category_id ?? null);
                        //vdd($products);
                        foreach ($products as $item) {
                            echo $this->require( '/render/cards/ZVMarketWidget/ready/main.php', [
                                'item' => $item,
                                'col' => 3
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

<?php echo ZReadMoreWidget::widget([
    'config' => [
        'parentclass' => 'parrentbody',
        'itemInSummary' => 6,
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
 ?>
<?php $this->endBody() ?>

</body>
</html>

<?php
$this->endPage()
?>
