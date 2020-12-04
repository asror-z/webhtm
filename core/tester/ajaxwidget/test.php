<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

use zetsoft\widgets\former\ZAjaxWidget;
use zetsoft\widgets\navigat\ZButtonWidget;

echo ZAjaxWidget::widget([
    'config' => [
        'func' => 'ajax',
    ],

    'event' => [
        'complete' => <<<JS
            function (text) {
                var value = JSON.parse(text.responseText);
                //console.log(value[1]);
                $('#text').text(text.responseText);
                console.log(text.responseText);
                $('#okButton').text(text.responseText);
                //console.log($('#okButton'));
            }
JS,
    ],

]);
echo ZButtonWidget::widget([
    'id' => 'okButton',
    'event' => [
        'click' => <<<JS
        function (text) {
         ajax('/ravshan/ravshan/notify.aspx');
    }
JS
    ],
]);
?>
