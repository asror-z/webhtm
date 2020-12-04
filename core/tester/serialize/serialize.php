<?php

use rmrevin\yii\fontawesome\FA;
use zetsoft\system\Az;
use zetsoft\widgets\former\ZAjaxWidget;
use zetsoft\widgets\navigat\ZButtonWidget;

?>
    <form id="form" action="" method="post">
        Name: <input type="text" name="name"><br>
        Age: <input type="text" name="email"><br>
        FavColor: <input type="text" name="favc"><br>
    </form>

<?php

echo ZButtonWidget::widget([
    'id' => 'secondary',
    'config' => [
        'btnType' => ZButtonWidget::btnType['button'],
        'text' => Az::l('Сохранить'),
    ],
    'event' => [
        'click' => <<<JS
       function (event) {
            ajaxSerialize('/core/tester/serialize/return1.aspx?' + $("#form").serialize());
       }
JS
    ]

]);

echo ZAjaxWidget::widget([
    'config' => [
        'func' => 'ajaxSerialize',
    ],
    'event' => [
        'success' => <<<JS
            function (text) {
                alert(text);
            }
JS,
    ],
]);
