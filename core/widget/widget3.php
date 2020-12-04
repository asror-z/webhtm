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
use zetsoft\models\core\CoreInput;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZVarDumper;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\themes\ZCardWidget;

/** @var ZView $this */
$action = new WebItem();

$action = new WebItem();
$action->type = WebItem::type['ajax'];
$action->debug = false;


$modelId = $this->httpGet('modelId');
$formDb = DragFormDb::findOne($modelId);
$widget = $formDb->widget;
$this->title = 'Виджет - ' . bname($widget);

if (!$widget) {echo 'Отсутствует Праметр widgetClass!';die;}

$service = Az::$app->smart->widget;

$opts = $this->httpGet('ZDynamicModel') ?? (new $widget)->_config;

$config = $service->conf($widget, $opts);

echo $widget::widget($configs);

$configs['model'] = $configs['model']->clazz;
$formDb->options = $configs;
$formDb->save();

?>
<div class="submit-button-widget">
    <?
   echo ZButtonWidget::widget([
        'config' => [
            'confirmTitle' => 'Подтверждение о сбросе',
            'hasConfirm' => true,
            'confirm' => Az::l('Вы действительно хотите сбросить настройки Виджета ') .
                '  -  ' . bname($widget),
            'btnRounded' => false,
            'text' => Az::l('Сброс'),
            'class' => 'btn btn-danger',
            'hasIcon' => true,
            'icon' => 'fas fa-trash',
            'btnType' => ZButtonWidget::btnType['submit'],
            'url' => '/core/widget/reset.aspx?modelId=' . $modelId,
        ]
    ]);

    ?>
</div>

<style>
    .submit-button-widget {
        display: flex;
        justify-content: flex-end;
        margin-top: 30px;
    }
</style>
