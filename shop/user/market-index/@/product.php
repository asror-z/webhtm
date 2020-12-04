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
?>


<div class="container-fluid bg-white">
    <div class="row py-3">
        <div class="col-3">
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
                    <h3>Основные Категории</h3>
                    <div id="contento" class="row w-100">
                        <?
                        $category_id = $this->httpGet('id');
                        $items = Az::$app->market->category->generateDBMenuItems();
                        foreach ($items as $item) {
                          echo $this->require('/render/cards/ZVMarketWidget/demo/Jamol_clean.php', ['item' => $item]);
                        
                        }

                        ?>
                    </div>
                    <h3>Категории</h3>
                    <div class="row">

                        <?
                        $category_id = $this->httpGet('id');
                        $items = Az::$app->market->category->generateDBMenuItems();
                        foreach ($items as $item) {
                            $values = [];
                            foreach ($item->items as $value){
                                $values = array_merge($values, $value->items);
                            }


                            foreach ($values as $v)
                            {
                                echo $this->require('/render/cards/ZVMarketWidget/ready/vmarket.php', ['item' => $v]);
                            }

                        }
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
