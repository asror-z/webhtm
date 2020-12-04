<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

use rmrevin\yii\fontawesome\FA;
use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\data\ALLApp;
use zetsoft\dbitem\data\Form;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\helpers\ZVarDumper;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\inputes\ZHHiddenInputWidget;
use zetsoft\widgets\inputes\ZHRadioButtonGroupWidget;
use zetsoft\widgets\inputes\ZInputWidget;
use zetsoft\widgets\inputes\ZKTouchSpinWidget;
use zetsoft\widgets\navigat\ZButtonWidget;

$action = new WebItem();

$action->type = WebItem::type['ajax'];

$get = $this->httpGet('ZDynamicModel');

$amount = 1;
$productId = ZArrayHelper::getValue($get, 'product_id');


unset($get['product_id']);


$form = $this->activeBegin();
$appModal = new ALLApp();

$compModel = Az::$app->market->company->getCompanyList($productId, []);

$compModelEl = ZArrayHelper::getValue($compModel, 0);

$column = new Form();
$column->title = 'element_id';
$column->widget = ZHHiddenInputWidget::class;
$column->value = '';
if ($compModelEl)
    $column->value = $compModelEl->id;
$appModal->columns['element_id'] = $column;

$column = new Form();
$column->title = 'amount';
$column->widget = ZKTouchSpinWidget::class;
/*$column->options = [
    'buttonup_txt' => '<i class="fa fa-plus"></i>',
    'buttondown_txt' => '<i class="fa fa-minus"></i>',
    'buttonup_class' => 'btn btn-success',
    'buttondown_class' => 'btn btn-success',
];*/
$column->value = $amount;
/*if ($compModelEl)
    $column->value = $compModelEl->shop_element_id;*/
$appModal->columns['amount'] = $column;

$column = new Form();

$column->widget = ZHRadioButtonGroupWidget::class;
$column->data = Az::$app->market->company->getUserList($compModel);
$appModal->columns['user_id'] = $column;

$appModal->cards = [];

echo ZFormWidget::widget([
    'model' => Az::$app->forms->former->model($appModal),
    'form' => $form,
    'config' => [
        'topBtn' => false,
        'botBtn' => false,
    ]

]);

echo ZButtonWidget::widget([
    'id' => 'addToCart',
    'config' => [
        'hasIcon' => true,
        'icon' => 'fa fa-' . FA::_SHOPPING_CART,
        'text' => 'Add to cart',
        //'type' => ZAjaxWidget::type['post'],
        //'color' => ZColor::color['white']
        /*'btnPaddingLeft' => ZButtonWidget::btnScale['0'],
        'btnPaddingRight' => ZButtonWidget::btnScale['0'],
        'btnPaddingTop' => ZButtonWidget::btnScale['0'],
        'btnPaddingBottom' => ZButtonWidget::btnScale['0'],*/
        'btnIconSize' => ZButtonWidget::btnScale['2.5'],
        'ajax' => true,
        'url' => ZUrl::to("/core/product/addToCart.aspx"),
        'data' => '{product_id:' . $productId . '}',  // xato bervotti tuzatib keyin ulela!!!!
        'btnType' => ZButtonWidget::btnType['submit'],
        'btnStyle' => ZButtonWidget::btnStyle['btn-danger']
    ],
    'event' => [
        'complete' => "function(data , textStatus , jqXHR){
                     console.log(data['responseText']);
                     $('#cart_total_amount').html(data['responseText']);
                }"
    ]
]);



$this->activeEnd();


?>


<script>

    $('#addToCart').click(function () {

        $.ajax({
            type: 'GET',
            url: ''
        });

    });


</script>
