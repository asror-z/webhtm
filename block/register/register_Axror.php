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
use zetsoft\widgets\themes\ZSignUpWidget_Axror;

if ($this->userIsGuest()){
   /* echo ZButtonWidget::widget([
        'config' => [
            'text' => Az::l('Вход | Регистрация'),
            'btnRounded' => true,
            'btn' => true,
            'btnStyle' => ZButtonWidget::btnStyle['btn-outline-success'],
            'btnType' => ZButtonWidget::btnType['link'],
            'url' => '/core/user/user-auth/login-register.aspx',
            'hasIcon' => false,
            'class' => 'z-depth-1 rounded text-muted',
        ]
    ]);*/

    ?>
    <a class="text-decoration-none text-muted" href="/core/user/user-auth/login-register.aspx"><i class="fal fa-sign-in-alt fp-28 mx-0 mx-md-3"></i></a>
<?php

}
else

    echo ZSignUpWidget_Axror::widget([

    ]);
 /*  echo ZButtonWidget::widget([
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
