<?php


use zetsoft\service\utility\Alert;
use zetsoft\system\Az;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZKAlertWidget;

echo ZKAlertWidget::widget([
    
    'config' => [
        'type' => \kartik\widgets\Alert::TYPE_DANGER,
        'body' => Az::l('Вход в систему Эл-юрт умиди'),
        'delay' => 0,
        'isShowSeparator' => true,
    ]
]);

echo ZButtonWidget::widget([
    'config' => [
        'text' => 'add-info->',
        'btn' => true,
        'btnRounded' => true,
        'toggle' => ZButtonWidget::toggle['tooltip'],
        'btnType' => ZButtonWidget::btnType['link'],
        'url' => '/eyuf/logics/scholar/add-info.aspx',
    ]
]);
