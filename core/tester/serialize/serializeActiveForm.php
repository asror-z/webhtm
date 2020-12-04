<?php

use kartik\widgets\ActiveForm;
use rmrevin\yii\fontawesome\FA;
use zetsoft\models\App\eyuf\EyufScholar;
use zetsoft\system\actives\ZAjaxForm;
use zetsoft\system\Az;
use zetsoft\widgets\former\ZAjaxWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\navigat\ZButtonWidget;

 ?>

<?php
$model = new EyufScholar();

$form = ActiveForm::begin([
    'id' => 'form',
]);

echo ZFormWidget::widget([
    'config' => [
        'topBtn' => false,
        'botBtn' => false,
    ],
    'model' => $model,
    'form' => $form
]);

ActiveForm::end();


echo ZButtonWidget::widget([
    'id' => 'secondary',
    'config' => [
        'btnType' => ZButtonWidget::btnType['button'],
        'text' => Az::l('Сохранить'),
    ],
    'event' => [
        'click' => <<<JS
       function (event) {
            ajaxSerialize('/core/tester/serialize/return2.aspx?'+ $("#form").serialize());
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
