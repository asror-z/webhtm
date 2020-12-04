<?php

use DebugBar\DataFormatter\VarDumper\DebugBarHtmlDumper;
use yii\data\Pagination;
use zetsoft\dbitem\core\WebItem;
use zetsoft\service\forms\Active;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\column\ZLinkPager;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\animo\ZFakeLoaderNewWidget;
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
        }, 2000)
        <?
        require Root . '/render/ajaxify/ZInfinityScrollAjaxWidget/asset/main.js';
        ?>
    </script>


</head>

<body class="<?= ZWidget::skin['white-skin'] ?> borderzz">


<?php

$this->beginBody();

require Root . '/webhtm/block/header/main.php';
require Root . '/webhtm/block/navbar/main.php';
require Root . '/render/menus/ZSidebarWidget/ready/main.php';

$this->fileJs('https://cdn.statically.io/gh/joaopereirawd/fakeLoader.js/master/js/fakeLoader.js');
$this->fileCss('https://cdn.statically.io/gh/joaopereirawd/fakeLoader.js/master/css/fakeLoader.css');
$this->pjaxBegin();


$post = $this->httpPost();
$filter = ZArrayHelper::getValue($post, 'ZDynamicModel');
$brand = ZArrayHelper::getValue($post, 'brand');

$price = ZArrayHelper::getValue($post, 'price_filter');
ZArrayHelper::remove($filter, 'hidden_input');

if (isset($filter))
    $this->sessionSet('filter', $filter);

if (isset($brand))
    $this->sessionSet('brand_filter', $brand);
else
    $this->sessionSet('brand_filter', []);


if (isset($price))
    $this->sessionSet('price_filter', $price);


?>


<div id="content" class="mb-5 mt-3">
    <div class="container-fluid bg-white">
        <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12 media-category">

                <div class="row">

                    <div class="col-12">

                        <?php
                        /** @var ZView $this */


                        $categoryId = $this->httpGet('id');

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
                           
                            $.ajax({
                                method: 'POST',
                                url: '/core/product/setFilter.aspx?' + $('#activeFormCheck').serialize(),
                                data: {},
                                beforeSend:function(){
                                    $('.lds-roller').show();
                                },
                                success: function(response) {
                                    $('#cards-filter').html(response);
                                    $('.lds-roller').hide();
                                    let lS=window.localStorage;
                                    let items=$('.appendTo .zcol,.appendTo .zlist');
                                    let zcol=$('.zcol');
                                    let zlist=$('.zlist');
                                    if(lS.getItem('grid')==='switch_to_list'){
                                        zcol.hide();
                                        zlist.show();
                                        $('#switch_to_col').addClass('text-success');
                                        $('#switch_to_col').removeClass('btn-success');
                                        $('#switch_to_list').removeClass('text-success');
                                        $('#switch_to_list').addClass('btn-success');
                                    }
                                    else{
                                        zcol.show();
                                        zlist.hide();
                                        $('#switch_to_list').addClass('text-success')
                                           $('#switch_to_list').removeClass('btn-success')
                                           $('#switch_to_col').removeClass('text-success');
                                        $('#switch_to_col').addClass('btn-success');
                                    }
                                    $('.lds-roller').hide()
                                    if (response.length>0){
                                        $('#no_content').hide()
                                    }
                                    else{
                                        $('#no_content').show()
                                    }
                                }
                            });
                            
                            //$('#cards-filter').show();
                        }
JS
                            ]
                        ]);

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

                        $this->activeEnd();

                        ?>

                    </div>

                </div>
            </div>

            <div class="col-lg-9 col-md-9 col-sm-12 col-12">

                <div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
                <?
                echo ZBreadcrumbsWidget::widget(); ?>

                <div class="switch-parent d-flex justify-content-end mr-4 mb-2">
                    <a class="btn btn-success rounded mt-0" id="switch_to_col" href="#col">
                        <i class="fas fa-th-large"></i>
                    </a>
                    <a class="btn btn-success rounded mr-2 mt-0" id="switch_to_list" href="#list">
                        <i class="fas fa-th-list"></i>
                    </a>
                </div>

                <div class="row d-flex" id="cards-filter">
                    <?php
                    $page = $this->httpGet('page');
                    if ($page === null) $page = 1;
                        $limit = $this->httpGet('per-page');

                    if ($limit === null) $limit = 10;

                    $items = Az::$app->market->product->allProducts($categoryId, null,
                        $page, $limit, []);

                    foreach ($items as $item) {
                        echo $this->require( '/render/cards/ZHCommonSaleWidget/ready/main.php', [
                            'item' => $item,
                            'isCommon' => false
                        ]);

                        echo $this->require( '/render/cards/ZVMarketWidget/ready/main.php', [
                            'item' => $item,
                            'isCommon' => false
                        ]);
                    }
                    ?>
                </div>
                <?php
                $pagination = new Pagination([
                    'totalCount' => Az::$app->market->product->max_page($categoryId),
                    'pageSize' => 10
                ]);


                echo ZLinkPager::widget([
                    'pagination' => $pagination
                ]);
                ?>

                <div id="no_content" class="my-5" style="display: none">
                    <div class="d-flex justify-content-center" >
                        <h1 class="d-block" style="font-size: 4.5rem"><i class="fa fa-search"></i></h1>
                    </div>
                    <div class="d-flex justify-content-center">

                        <h5 class="d-block"><?=Azl.'По текущим данным продукты отсутствуют '?></h5>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>


<? $this->pjaxEnd(); ?>

<script>

    $('#no_content').hide()
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
