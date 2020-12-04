<?php

use kartik\select2\Select2; // or kartik\select2\Select2
use yii\web\JsExpression;
use zetsoft\models\user\User;


// Get the initial city title

echo Select2::widget([
    'options' => ['multiple'=>true, 'placeholder' => 'Search for a city ...'],
    'pluginOptions' => [
        'allowClear' => true,

        'ajax' => [
            'url' => 'http://eyuf.zettest.uz/core/tester/sunnat/ajax.aspx',
            'dataType' => 'json',
            'data' => new JsExpression('function(params) { return {q:params.term}; }')
        ],
    ],
]);









