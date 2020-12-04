<?php

use zetsoft\dbitem\data\ALLApp;
use zetsoft\dbitem\data\Form;
use zetsoft\service\forms\Active;
use zetsoft\system\Az;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\inputes\ZInputWidget;
use zetsoft\widgets\inputes\ZMImageRadioGroupWidget;


if (!empty($product->properties)) {
    $active = new Active();
    $active->id = 'formModal';
    $active->class = 'pl-2';
    $form = $this->activeBegin($active);
    $app = new ALLApp();
    foreach ($product->properties as $props) {
        $value[] = array_key_first($props->items);
    }
    
    foreach ($product->properties as $key => $property_group) {

        $string_n = [];
        $column1 = new Form();
        $column1->title = $property_group->name;
        $column1->widget = ZMImageRadioGroupWidget::class;
        $column1->options = [
            'data' => $string_n,
            'config' => [
                'url' => ZMImageRadioGroupWidget::imageUrl['radio'],
                'checkMarkPosition' => ZMImageRadioGroupWidget::checkMarkPosition['top-left'],
                'checkMarkSize' => '22px',
                'display' => ZMImageRadioGroupWidget::display['inline-block'],
                'imageSize' => '', //only pixel
                'title' => $property_group->name
            ],
            'event' => [
                'onclick' => <<<JS
                    function() {
                        $(this).submit();  
                    }
JS,

            ],
            'value' => $value
        ];
       
        $array[] = $property_group->items;

        if ($array === '' || $array === null) {
            $array = ['0'];
        }

        foreach ($property_group->items as $option) {
            $string_n[] = $option;
        }

        $column1->value = array_key_first($property_group->items);
        $column1->data = $property_group->items;
        $column1->rules = [['zetsoft\\system\\validate\\ZRequiredValidator']];
        $app->columns['key' . $key] = $column1;

    }

    $column = new Form();
    $column->title = $product->id;
    $column->widget = ZHInputWidget::class;
    $column->options = [
        'config' => [
            'type' => ZInputWidget::type['hidden']
        ]
    ];
    $column->value = $product->id;
    $catalogId = $product->id;
 
    $app->columns['product_id'] = $column;
    $app->cards = [];
    $model = Az::$app->forms->former->model($app);
   
    //$model = Az::$app->market->filter->singleProductForm(422);

    echo ZFormWidget::widget([
        'model' => $model,
        'form' => $form,
        'config' => [
            'topBtn' => false,
            'botBtn' => false,
        ],
        'event' => [
            'formChange' => <<<JS
    function() {
        $(this).submit();
        $('#refreshMarketList').click();
        $('#market_list').css({"opacity": "0.5","z-index": "-1"});
        $('.market-company').parent().appendTo("#market_list");
        $('.market-company').removeClass("d-none");
        $('.market-company').parent().css({"z-index": "1"});
    }
JS

        ]
    ]);

    $this->activeEnd();
}


?>


<script>
    $(document).on('change', '#formModal', function () {
        $(this).submit()
    })

</script>
