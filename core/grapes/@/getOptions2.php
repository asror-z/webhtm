<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

use zetsoft\models\drag\DragFormDb;
use zetsoft\system\actives\ZAjaxForm;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\navigat\ZGAccordionWidget;
use zetsoft\widgets\navigat\ZMarketDropdownWidget;

/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Настройка Опций Виджетов';
$action->icon = 'fa fa-rocket rss';
$action->type = WebItem::type['ajax'];



$getConfigs = $this->httpGet('configs');
$widget = str_replace('/', '\\', $this->httpGet('param'));

if (!$widget) {echo('Виджет не Выбран!'); die;}

$formDb = new DragFormDb();
$service = Az::$app->smart->widget2;

# МОДЕЛЬ НАСТРОЕК КОНКРЕТНОГО ВИДЖЕТА
$optionsForm = $service->allOptions($widget);

$configs = json_decode($getConfigs, true) ?? (new $widget())->_config;

?>

<div class="container-fluid">

    <?
    $form = ZAjaxForm::begin([
        'id' => 'activeForm'
    ]);

    $basename = bname($widget);

    #КНОПКА SUBMIT ДЛЯ ФОРМЫ

    echo ZButtonWidget::widget([
        'id' => 'sendOptions',
        'config' => [
            'hidden' => true,
        ]
    ]);

    foreach ($optionsForm as $key => $value)
        echo ZGAccordionWidget::widget([
            'config' => [
                'content' => ZFormWidget::widget([
                    'config' => [
                        'topBtn' => false,
                        'botBtn' => false,
                    ],
                    'model' => $value,
                    'form' => $form
                ]),
                'title' => $key,
            ]
        ]);

    ZAjaxForm::end();

    ?>

</div>




<style>

    #sendOptions {
        visibility: hidden;
    }

</style>

<script>
    $(document).on('change', 'input[type="text"]', function () {
        $('#sendOptions').click();
    });
</script>
