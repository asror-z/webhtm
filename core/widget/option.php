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
use zetsoft\widgets\navigat\ZMarketDropdownWidget;

/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Настройка Опций Виджетов';
$action->icon = 'fa fa-rocket rss';
$action->type = WebItem::type['ajax'];

$widgetName = str_replace('/', '\\', $this->httpGet('widget'));
$service = Az::$app->smart->widget;
$formDb = new DragFormDb();


if (!$widgetName) {
    echo('Виджет не Выбран!');
    die;
}

# МОДЕЛЬ НАСТРОЕК КОНКРЕТНОГО ВИДЖЕТА
$widgetForm = $service->widgetOptions($formDb, $widgetName);

# МОДЕЛЬ НАСТРОЕК ZWIDGET
$mainForm = $service->options($formDb, $widgetName);

# МОДЕЛЬ ДОБАВЛЕНИЯ ОПЦИИ DATA
$addData = $service->addData();

# МОДЕЛЬ Выбрать Модель
$addModel = $service->addModel();

?>

<div class="container-fluid">

        <?

        $form = ZAjaxForm::begin([
            'id' => 'activeForm'
        ]);

        $configs = (new $widgetName)->_config;

        if (!empty($this->httpGet('configs')))
            $configs = json_decode($this->httpGet('configs'), true);


        #КНОПКА SUBMIT ДЛЯ ФОРМЫ

        echo ZButtonWidget::widget([
             'id' => 'sendOptions',
             'config' => [
                'hidden' => true
             ]
        ]);



        #НАСТРОЙКИ КОНКРЕТНОГО ВИДЖЕТА

        $widgetForm->attributes = ZArrayHelper::merge($widgetForm->attributes, $configs);

        echo ZFormWidget::widget([
            'model' => $widgetForm,
            'form' => $form,
            'config' => [
                'topBtn' => false,
                'botBtn' => false,
            ]
        ]);



        #ОБЩИЕ НАСТРОЙКИ ZWIDGET

        $mainForm->attributes = ZArrayHelper::merge($mainForm->attributes, $configs);

        echo ZFormWidget::widget([
            'model' => $mainForm,
            'form' => $form,
            'config' => [
                'topBtn' => false,
                'botBtn' => false,
            ]
        ]);



        #ДОБАВЛЕНИЕ ПАРАМЕТРА DATA ДЛЯ ВИДЖЕТА

        $addData->attributes = ZArrayHelper::merge($addData->attributes, $configs);

        echo ZFormWidget::widget([
            'model' => $addData,
            'form' => $form,
            'config' => [
                'topBtn' => false,
                'botBtn' => false,
            ]
        ]);

        #Выбрать Модель DATA ДЛЯ ВИДЖЕТА

        $addModel->attributes = ZArrayHelper::merge($addModel->attributes, $configs);

        echo ZFormWidget::widget([
            'model' => $addModel,
            'form' => $form,
            'config' => [
                'topBtn' => false,
                'botBtn' => false,
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

    $(document).on('click', '.js-input-remove', function () {
        $('#sendOptions').click();
    });
</script>
