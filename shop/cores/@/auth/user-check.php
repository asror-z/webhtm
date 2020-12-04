<?php

use kartik\widgets\Alert;
use zetsoft\models\user\User;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\notifier\ZKAlertWidget;

echo ZKAlertWidget::widget([
    'config' => [
        'type' => Alert::TYPE_DANGER,
        'iconType' => 'icon',
        'body' => 'Вы уже зарегистрированы',
        'title' => 'Ошибка !',
        'delay' => 0,
        'icon' => 'fas fa-remove-circle',
        'hasIcon' => true,
        'isShowSeparator' => true,
    ]
]);
