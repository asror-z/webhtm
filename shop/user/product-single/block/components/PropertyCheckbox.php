<?php


use zetsoft\dbitem\data\ALLApp;
use zetsoft\dbitem\data\ConfigDB;
use zetsoft\dbitem\data\Form;
use zetsoft\service\forms\Active;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\inputes\ZBootstrapBorderGroupWidgetM;
use zetsoft\widgets\inputes\ZHInputWidget;
use zetsoft\widgets\inputes\ZInputWidget;

$productId = (int)ZArrayHelper::getValue($get, 'product_id');

if ($productId === $this->httpGet('id'))
    unset($get['product_id']);
else
    $get = [];


$configs = new ConfigDB();
$configs->columnCount = 2;

$active = new Active();
$active->id = 'formModal';
$active->childClass = 'px-2 form-child fp-20 ';
$active->class = 'row my-3 d-flex justify-content-between flex-wrap';

$form = $this->activeBegin($active);

$app = new ALLApp();
$app->configs = $configs;

if ($product->properties === null) {
    echo 'propertyla yoq';
    return null;
}

foreach ($product->properties as $key => $property_group) {
    
    if (!empty($get)) {
        $val = $get;
        $get = [];
    }

    if (!isset($val))
        $val = [];

    $string_n = [];

    foreach ($property_group->items as $shop_option_ids => $elementNames) {
        $string_n[$shop_option_ids] = $elementNames;
    }

    $column1 = new Form();
    $column1->title = '';
    $column1->widget = ZBootstrapBorderGroupWidgetM::class;
    $column1->options = [
        'data' => $string_n,
        'value' => $val,
        'config' => [
            'containerClass' => 'radio-' . $key,
            'title' => $property_group->name . ':',
        ],
    ];

    $array[] = $property_group->items;

    $column1->value = array_key_first($property_group->items);
    $column1->data = $property_group->items;
    $column1->rules = [['zetsoft\\system\\validate\\ZRequiredValidator']];
    $app->columns['key' . $key] = $column1;

}

$column = new Form();
$column->title = '';
$column->widget = ZHInputWidget::class;
$column->options = [
    'config' => [
        'type' => ZInputWidget::type['hidden'],
    ],
    'value' => $product->id
];

$app->columns['product_id'] = $column;
$app->cards = [];

$model = Az::$app->forms->former->model($app);
$model->configs->hasLabel = false;

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
                    url: '/core/product/getCompanyD.aspx',
                    data: $('#formModal').serialize(),
                    beforeSend: function(){
                        $('.lds-roller').show();
                    },
                    success: function(response) {
                         $('#market').html(response);
                                                 
                         $('.lds-roller').hide();
                         if (response.length>189){
                            $('html ,body').animate({
                                scrollTop: $("#market").offset().top -143
                            }, 1000);}
                    }
                });
            }
JS
    ]
]);
$this->activeEnd();


if (empty($product->properties)) :
    echo <<<HTML
    <script>
        $.ajax({
            method: 'POST',
            url: '/core/product/getCompanyD.aspx',
            data: $('#formModal').serialize(),
            success: function(response) {
                $('#market').html(response);
            }
        });
    </script>
HTML;
    return 0;
endif;
