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
require Root . '/render/menus/ZSidebarWidget/ready/main.php';
?>


<div class="container-fluid bg-white">
    <div class="row py-3">
        <div class="col-3">
            <div class="row mx-1">
                <div class="col-12">

                    <?= $this->require( '/webhtm/shop/user/filter-common/blocks/parent.php') ?>
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
                            'class' => 'text-center btn-block',
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
                                'mainUrl' => '/shop/user/filter-common/main',
                                'mode' => ZBreadcrumbsWidget::mode['category'],
                                'category_id' => $category_id
                            ]
                        ]);
                    ?>
                </div>
                   <!-- --><?php
/*                    $this->pjaxBegin();
                    */?>
                <div class="col-md-12 pl-0">

                                <?php
                                /** @var ZView $this */
                                echo $this->require('/render/cards/ZListViewWidget/ready/tab_product.php');
                                ?>

                            </div>

                <div class="col-12">
                    <?php
                    Pjax::begin();
                    ?>
                    <div id="contento" class="row w-100">
                        <?

                        //$this->pjaxBegin();
                        $category_id = $this->httpGet('id');
                        $products = Az::$app->market->product->allProducts($category_id ?? null);

                       /* echo ZInfinityScrollAjaxWidget::widget([
                            'config' => [
                                'url' => '/blocks/infinite/infinite.aspx', 'requireUrl'=>'/render/cards/ZListViewWidget/ready/vertical_horizontal_infinity.php',
                                'limit'=>6,
                                'cols'=>2
                            ]
                        ]);*/

                        //$this->pjaxEnd();

                        ?>


                    </div>
                    <?php Pjax::end(); ?>
                </div>
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
echo ZReadMoreWidget::widget([

    'config' => [

        'itemInSummary' => 8,
        'parentclass' => 'menu-container',
        'itemClass' => 'mode',
    ]
]);
 ?>
<?php $this->endBody() ?>

</body>
</html>

<?php
$this->endPage()
?>
