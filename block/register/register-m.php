<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

use zetsoft\system\Az;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\themes\ZCarolinaWidget;
use zetsoft\widgets\themes\ZSignUpWidget;

if ($this->userIsGuest())
    echo ZButtonWidget::widget([
        'config' => [
            'text' => Az::l(''),    /*Вход | Регистрация*/
            'btnRounded' => false,
            'btn' => false,
            'btnStyle' => ZButtonWidget::btnStyle['none'],  /**/
            'btnType' => ZButtonWidget::btnType['link'],
            'url' => '/core/user/user-auth/login-register.aspx',
            'hasIcon' => true,
            'icon' => 'fal fa-user text-success fp-20',
            'class' => 'border-0',
        ]
    ]);
else

    echo ZSignUpWidget::widget([

    ]);
 /*   echo ZButtonWidget::widget([
        'config' => [
            'text' => Az::l('Выход'),
            'icon' => 'fas fa-sign-in-alt',
            'btnRounded' => true,
            'btn' => true,
            'btnStyle' => ZButtonWidget::btnStyle['btn-outline-danger'],
            'btnType' => ZButtonWidget::btnType['link'],
            'url' => '/core/user/user-auth/logout.aspx',
            'hasIcon' => true,
            'class' => 'z-depth-1 rounded',
        ]
    ]);*/
