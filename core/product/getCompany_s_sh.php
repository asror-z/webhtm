<?php


use PhpOffice\PhpSpreadsheet\Chart\Axis;
use PhpOffice\PhpSpreadsheet\Shared\OLE\PPS\Root;
use rmrevin\yii\fontawesome\FA;
use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\shop\CompanyCardItem;
use zetsoft\dbitem\ALL\ZProductItem;
use zetsoft\dbitem\data\ALLApp;
use zetsoft\dbitem\data\Config;
use zetsoft\dbitem\data\Form;
use zetsoft\service\forms\Active;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\helpers\ZVarDumper;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\cards\ZMiniStoreWidget;
use zetsoft\widgets\former\ZAjaxWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\inputes\ZImageCheckboxGroupWidget;
use zetsoft\widgets\inptest\ZImageCheckboxGroupWidgetA;
use zetsoft\widgets\inputes\ZHHiddenInputWidget;
use zetsoft\widgets\inputes\ZHRadioButtonGroupWidget;
use zetsoft\widgets\inputes\ZInputWidget;
use zetsoft\widgets\inputes\ZKTouchSpinWidget;
use zetsoft\widgets\inputes\ZMImageRadioCompanyWidget;
use zetsoft\widgets\inputes\ZRadioGroupWidget;
use zetsoft\widgets\cards\ZMiniCardWidget;
use zetsoft\widgets\inputes\ZMImageRadioGroupWidget;
use zetsoft\widgets\market\ZSVGWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\navigat\ZSlimScrollWidget;
use function Dash\Curry\get;

$action = new WebItem();

$action->title = Azl . 'Создание Веб-действия';
$action->icon = 'fa fa-pie-chart';
$action->type = WebItem::type['ajax'];
$action->csrf = true;
$action->debug = true;



$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();


$this->paramSet('widget', true);
$get = $this->httpGet('ZDynamicModel');

/** @var ZView $this */
//$this->sessionSet('search', $get->attributes);

$productId = ZArrayHelper::getValue($get, 'product_id');
unset($get['product_id']);
 //vdd($productId);
//$amount = 1;
$set = Az::$app->market->product->catalogsByElement($productId, $get);
$item = [];
/** @var CompanyCardItem $value */
/*foreach ($set as $value) {
    $item[$value->id] = ZMiniCardWidget::widget([
        'config' => [
            'name' => $value->name,
            'price'=> $value->price,
            'image'=> $value->image,
        ]
    ]);
}*/
if ($set){

    foreach ($set as $value) {
        $item[$value->id] = ZMiniStoreWidget::widget([
            'config' => [
                'readonly' => true,
                'item' => $value
            ]
        ]);
    }

$app = new ALLApp();
$config = new Config();
$config->title = 'sell';

$active = new Active();
$active->id = 'compForm';

$form = $this->activeBegin($active);

$column = new Form();
$column->title = 'category';
$column->widget = ZMImageRadioCompanyWidget::class;
$column->options = [
    'config' => [
        'url' => ZMImageRadioGroupWidget::imageUrl['none'],
    ],
    'event' => [
        'onclick' => '
            function () {
                $(".hiddenButton").removeClass("d-none");
                $(".imgCheckbox2 ").css("border","none");
            }
        '
    ]
];
$column->data = $item;
//vdd($item);
$app->columns['catalog'] = $column;


$column = new Form();
$column->title = Az::l("Количество");
$column->widget = ZKTouchSpinWidget::class;
$column->options = [

    'config' => [
        'min' => '0',
        'max' => '10000',
        'step' => '1',
        'buttonup_txt' => '<i class="fa fa-plus fa-2x"></i>',
        'buttondown_txt' => '<i class="fa fa-minus text-danger fa-2x"></i>',
        'buttonup_class' => 'btn btn-outline-success btn-sm',
        'buttondown_class' => 'btn btn-outline-danger btn-sm',
        'class' => 'text-center touch-single'
    ],
    'event' => [
        'startupspin' => <<<JS
        function () {
                var amount = $(this).val();
                   $.ajax({
                      url: '/shop/core/product/setToCart.aspx',
                      data: {
                            catalog_id: $productId,
                            amount: amount,
                      },
                      success: function(data) {
                        $('#cart_total_amount').html(data);
                      }
                      
                   })
                }
JS,
    'startdownspin' => <<<JS
        function () {
              var amount = $(this).val();
              
                   $.ajax({
                      url: '/shop/core/product/setToCart.aspx',
                      data: {
                            catalog_id: $productId,
                            amount: amount!==1 ? amount-- : amount,
                      },
                      success: function(data) {
                        $('#cart_total_amount').html(data);
                      }
                      
                   })
                }
            
JS,


    ]
];

$app->columns['amount'] = $column;

$app->cards = [];

$model = Az::$app->forms->former->model($app);


echo ZFormWidget::widget([
    'model' => $model,
    'form' => $form,
    'config' => [
        'topBtn' => false,
        'botBtn' => false,
    ]

]);
?>

<div class="basket d-none mb-1">
<?php
echo ZSVGWidget::widget([
    'config' => [
        'type' => ZSVGWidget::type['basket_delete']
    ]
]);
?>
</div>

<div class="col-md-11">
<?php
echo ZButtonWidget::widget([
    'config' => [
        'class' => 'd-none btn-block hiddenButton',
        'text' => Az::l('Добавить в корзину'),
        'btnStyle' => ZColor::btnStyle['btn-outline-success'],
        'btnRounded' => false,
        'btnType' => ZButtonWidget::btnType['button'],
        'type' => ZAjaxWidget::type['get'],
        'ajax' => true,
        'url' => ZUrl::to(["/shop/core/product/setToCart.aspx"]),
        'dataType' => 'html',
        'data' => "$('#compForm').serialize()",
        'icon' => 'mr-1 fa fa-' . FA::_SHOPPING_CART,
        'hasIcon' => true
    ],
    'event' => [
        'success' => 'function (data) {
                    $(\'#cart_total_amount\').html(data);
                }',
        'click' => 'function() {
            var touchSpin = $(\'.bootstrap-touchspin\');
            var parent = touchSpin.parent();
            var svg = $(\'.basket\');
            touchSpin.append(svg);
            parent.removeClass(\'col-md-12\');
            parent.addClass(\'col-md-11\');
            $(\'.bootstrap-touchspin\').removeClass(\'d-none\');
            $(\'.basket\').removeClass(\'d-none\');
            $(this).addClass(\'d-none\');
        }'
    ]
]);
?>
</div>
<script>
    $('.clear-add').on("click", function () {
       var basket = $(this).parent();
       var main = basket.parent();
       var spin = main.children('.touch-single');
       spin.val('');
       $('.basket').addClass("d-none");
       main.addClass('d-none');
       $('.hiddenButton').removeClass('d-none');
    });
</script>

<?php



$this->activeEnd();
 echo "<script>
    $(document).ready(function () {
        $('.bootstrap-touchspin').addClass('d-none');
    });
</script>";
}else{echo "
<div class=''>
    <h5 class='text-center'>К сожалению, продукт с такими свойствами не осталось в наших магазинах.</h5>
    <img class='w-50 mx-auto d-block' src='/render/market/@Weak/images/empty_market.jpg'>
</div>
";
}

?>




