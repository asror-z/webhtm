<?php

use yii\widgets\Pjax;
use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\wdg\MenuItem;
use zetsoft\service\forms\Ajaxer;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZInfinityScrollAjaxWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\inputes\ZKRangeWidget;
use zetsoft\widgets\navigat\ZMarketDropdownWidget;
use zetsoft\widgets\menus\ZMetisMenuWidget;
use zetsoft\widgets\navigat\ZBreadcrumbsWidget;


/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Категория';
$action->icon = 'fa fa-area-chart';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;



$model = 'model';


$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

/** @var ZView $this */
$category_id = $this->httpGet('id');
//$items = Az::$app->market->category->generateDBMenuItems();
if (!isset($category_id)){
    $category_id = 19;
}
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







$this->beginPage();


?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>

    <?php

    $this->require ( Root . '/webhtm/block/metas/main.php');
    $this->require ( Root . '/webhtm/block/assets/main.php');


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
                <div class="col-12 border border-light rounded">
                    <h4>Смежные категории</h4>
                    <?php

                    /*echo \zetsoft\widgets\menus\ZMetisMenuWidget::widget([
                        'config' => [
                            'MenuOpen' => true,
                            'type' => ZMetisMenuWidget::type['Category'],
                        ],
                    ]);*/
                     echo zetsoft\widgets\market\ZMenuWidget::widget([
                     'config' => [
                     'open' => true,
                     'mode' => 'shop'
                     ],
                     ]);
                     


                    /** @var ZView $this */

                    //$active = new Ajaxer();
                    //$active->id = 'activeFormCheck';
                    //$active->showLabels = false;

                    //$form = $this->ajaxBegin($active);
                    $form =null;
                    //$models = Az::$app->smart->widget->getFilter();
                    $models =  [];
                    //vdd($models);
                    foreach ($models as $title => $model)
                    {
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
                    ?>


                </div>

            </div>
        </div>
                <div class="col-lg-9 col-sm-6">
                    <?php
                    Pjax::begin();
                    ?>
                    <h3>Основные Категории</h3>
                    <div id="contento" class="row w-100">
                        <?
                        foreach ($items as $item) {
                            //vdd($item);
                            echo $this->require( '/render/cards/ZVMarketWidget/ready/card.php', ['item' => $item]);
                        }
                        ?>
                    </div>
                    <h3>Категории</h3>
                    <div class="row">
                        <?php

                        $this->pjaxBegin();

                        use zetsoft\dbitem\shop\ProductItem;
                        
                        //$exam =  Az::$app->market->product->allProducts();


                        /** @var ZView $this */
                        //$model = Az::$app->market->product->allProducts();
                        echo ZInfinityScrollAjaxWidget::widget([
                            'config' => [
                                'requireUrl' => '/render/cards/ZVMarketWidget/ready/main.php',
                                'limit' => 4,
                                'items' => $model,
                                'type' => 'ajax',
                                'url' => '/blocks/infinite/infinite_abl.aspx',
                            ]
                        ]);

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
