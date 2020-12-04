<?php

use DebugBar\DataFormatter\VarDumper\DebugBarHtmlDumper;
use zetsoft\dbitem\core\WebItem;
use zetsoft\service\forms\Active;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\navigat\ZBreadcrumbsWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\navigat\ZReadMoreWidget;

/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Продукты по категориям';
$action->icon = 'fa fa-area-chart';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;



$this->fileJs('/render/ajaxify/ZInfinityScrollAjaxWidget/asset/main.js');

$marketId = $this->httpGet('marketId');
$categoryId = $this->httpGet('categoryId');
$this->paramSet(paramAction, $action);
$this->title();
$this->toolbar();

/** @var ZView $this */
$this->beginPage();

/** @var ZView $this */
$this->fileCss('/render/asrorz/css/loader.css');

?>

<html lang="<?= Yii::$app->language ?>">
<head>

    <?php

    require Root . '/webhtm/block/metas/main.php';
    require Root . '/webhtm/block/assets/main.php';


    $this->head();

    ?>

<!--<script src="/render/ajaxify/ZInfinityScrollAjaxWidget/asset/main.js"></script>-->
    <script>

        $('.lds-roller').show();
        setTimeout(function () {
            $('.lds-roller').hide();
        },2000)
    </script>
</head>

<body class="<?= ZWidget::skin['white-skin'] ?> borderzz">


<?php

$this->beginBody();

require Root . '/webhtm/block/header/main.php';
require Root . '/webhtm/block/navbar/main.php';
require Root . '/render/menus/ZSidebarWidget/ready/main.php';
$this->pjaxBegin();

?>


<div id="content" class="mb-5 mt-3">
    <div class="container-fluid bg-white">
        <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12 media-category">

                <div class="row">

                    <div class="col-12">
                       
                        <?php
                        /** @var ZView $this */

                        $post = $this->httpPost();
                        $filter = ZArrayHelper::getValue($post, 'ZDynamicModel');

                        $brand = ZArrayHelper::getValue($post, 'brand');
                        
                        $price = ZArrayHelper::getValue($post, 'price_filter');
                        ZArrayHelper::remove($filter, 'hidden_input');
                        if (isset($filter))
                            $this->sessionSet('filter', $filter);
                        //$this->sessionSet('price_filter', $price);
                        if (isset($brand))
                            $this->sessionSet('brand_filter', $brand);

                        //$items = Az::$app->market->product->allProducts(457, null, 1, 10, []);
                       
                        $categoryId = $this->httpPost('id');

                        $active = new Active();
                        $active->id = 'activeFormCheck';

                        $form = $this->activeBegin($active);

                        $model = Az::$app->market->filter->filterFormItemsSession(457);

                        if ($this->formModel($model)) {

                        }

                        echo ZFormWidget::widget([
                            'model' => $model,
                            'form' => $form,
                            'config' => [
                                'topBtn' => false,
                                'botBtn' => false,
                            ],
                            'event' => [
                                'formChange' => <<<JS
                        function (event) {
                            $(this).submit();
                            $('#cards-filter').loader('show');
                        }
JS
                            ]
                        ]);

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

                        $this->activeEnd();

                        ?>
                    </div>
                </div>
            </div>

            <div class="col-lg-9 col-md-9 col-sm-12 col-12">
                <? echo ZBreadcrumbsWidget::widget([
                    'config' => [
                        'mode' => ZBreadcrumbsWidget::mode['category'],
                        'category_id' => $categoryId,
                    ]
                ]); ?>

                <div class="switch-parent d-flex justify-content-end mr-4 mb-2">
                    <a class="btn btn-success rounded mt-0" id="switch_to_col" href="#col">
                        <i class="fas fa-th-large"></i>
                    </a>
                    <a class="btn btn-success rounded mr-2 mt-0" id="switch_to_list" href="#list">
                        <i class="fas fa-th-list"></i>
                    </a>
                </div>

                <?

                echo date('H:i:s');
                ?>
                <div class="row d-flex" id="cards-filter">
                    <?php

                    $items = Az::$app->market->product->allProducts($categoryId, null,
                     1, 10, []);

                    foreach ($items as $item) {
                        echo $this->require( '/render/cards/ZHCommonSaleWidget/ready/main.php', [
                            'item' =>$item,
                            'isCommon' => false
                        ]);

                        echo $this->require( '/render/cards/ZVMarketWidget/ready/main.php', [
                            'item' =>$item,
                            'isCommon' => false
                        ]);
                    }
                    ?>
                </div>
            </div>

        </div>
    </div>

</div>


<? $this->pjaxEnd(); ?>

<script>

    $(function () {
        $('.inner-content-div').slimScroll({
            height: '250px'
        });
    });



    $(document).on('pjax:end', function () {
        $('.lds-roller').hide()
    })

</script>

<!--
--><?php /*echo ZReadMoreWidget1::widget([
    'config' => [
        'parentclass' => 'parrentbody',
        'itemInSummary' => 3,
        'itemClass' => 'es-selectable',
    ]
]);

echo ZReadMoreWidget1::widget([

    'config' => [

        'itemInSummary' => 2,
        'parentclass' => 'accPanelBody',
        'itemClass' => 'optionCheckBoxes',
    ]
]);
echo ZReadMoreWidget1::widget([

    'config' => [

        'itemInSummary' => 8,
        'parentclass' => 'menu-container',
        'itemClass' => 'mode',
    ]
]);*/
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
