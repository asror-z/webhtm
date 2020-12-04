<?php

use zetsoft\widgets\former\ZAjaxWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\navigat\ZButtonWidget2;

# 98 331-26-24 15-000
?>
    <input type="text" id="input">
<?php
echo ZButtonWidget2::widget([
    'config' => [
        'text' => 'ajax2',
        'ajax' => true,
        'url' => '/core/tester/umid/serverside.aspx',
        'type' => ZAjaxWidget::type['get'],
        'data' => "name : 'Yan', surname : 'Oblak'"
    ],
]);



echo ZButtonWidget::widget([
    'config' => [
        'ajax' => true,
        'text' => 'ajax1',
    ],
    'event' => [
        'click' => <<<JS
    function () {
        ajaxTest('/core/tester/umid/serverside.aspx?data=aad')  
    }
JS
    ]
]);

echo ZAjaxWidget::widget([
    'config' => [
        'func' => 'ajaxTest',
        'data' => '',
        'type' => ZAjaxWidget::type['get'], //"POST", "GET", "PUT"
    ]
]);
