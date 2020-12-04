<?php

use yii\widgets\Pjax;
use zetsoft\dbitem\core\WebItem;
use zetsoft\models\shop\ShopCatalog;
use zetsoft\models\shop\ShopOrder;
use zetsoft\models\shop\ShopProduct;
use zetsoft\models\user\User;
use zetsoft\service\forms\Active;
use zetsoft\service\forms\Ajaxer;
use zetsoft\service\forms\ZPjax;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZStringHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\former\ZEditRavWidgetAzimjon;
use zetsoft\widgets\former\ZEditRavWidgetD;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\former\ZListViewWidget;
use zetsoft\widgets\inputes\ZCurrencyRadioWidget;
use zetsoft\widgets\inputes\ZKRangeWidget;
use zetsoft\widgets\inputes\ZMImageRadioGroupWidgetAzimjon;
use zetsoft\widgets\inputes\ZSelect2Widget;
use zetsoft\widgets\menus\MenuItemWidget;
use zetsoft\widgets\menus\ZMetisMenuWidget;
use zetsoft\widgets\market\ZMenuWidget;
use zetsoft\widgets\menus\ZSidebarWidget;
use zetsoft\widgets\navigat\ZBreadcrumbsWidget;
use zetsoft\widgets\navigat\ZButtonWidget;

/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Категория Azimjon';
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
    <style>

        #sendValues {
            visibility: hidden;
        }

        [type=radio]:checked, [type=radio]:not(:checked){
            opacity: 1;
            pointer-events: auto;
        }

    </style>
</head>
<body class="<?= ZWidget::skin['white-skin'] ?> borderzz">

<?php $this->beginBody(); 
require Root . '/webhtm/block/navbar/mainAzimjon.php';


$current_currency = Az::$app->cores->session->get('currency');
$core_catalog = new ShopCatalog();

//$currencyLowercase = strtolower((string)$core_catalog->_currency);

/** @var ZView $this */

$core_catalog = new ShopCatalog();

echo ZEditRavWidgetD::widget([
    'name' => 'currency',
    'config' => [
        'session' => true,
        'widgetClass' => ZCurrencyRadioWidget::class,
        'options' => [
            'data' => $core_catalog->_currency,
            'config' => [
                'url' => ZCurrencyRadioWidget::imageUrl['checkbox'],
                'checkMarkPosition' => ZCurrencyRadioWidget::checkMarkPosition['top-right'],
                'checkMarkSize' => '15px',
            ]
        ]
    ],
    'event' => [
        'editableAjaxSuccess' => <<<JS
        location.reload()
JS,

    ]
]);
/*echo ZSelect2Widget::widget([
    'config' => [
        'placeholder' => 'Выберите Валюту',
        'allowClear' => true,
        'theme' => ZSelect2Widget::theme['bootstrap'],
        'isHideSearch' => true,
        'selectColor' => '#f2faf2',
        'selectedColor' => '#e8e8e8',
        'size' => ZSelect2Widget::size['lg'],
        'imagePath' => false,
    ],
    'name' => 'currency',
    'data' => $core_catalog->_currency,
    'value' => $current_currency,
    'event' => [
        'select' => <<<JS
                function () {
                    var selectC = $(this);
                    $.ajax({
                        method: "GET",
                        url: "/core/product/setCurrency.aspx",
                        data: {
                        currency: selectC.val(),
                        },
                        success: function(data){
                        console.log(data);
                        },
                        error:  function() {
                        //alert('error');
                        }
                    })
                }
                            
JS,

    ]
]);*/

?>

<section class="menu ml-3">
    <div class="row">
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
                ?>
            </div>
            <?php Pjax::end(); ?>
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
