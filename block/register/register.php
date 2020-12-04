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

if ($this->userIsGuest()){
    ?>
    <a class="text-decoration-none text-muted hint--left p-0" aria-label="Вход | Регистрация" href="/core/user/user-auth/registerCRM.aspx"><i class="fal fa-sign-in-alt fp-28"></i></a>
<?php

}
else

    echo ZSignUpWidget::widget([
        'config' => [
            'profile_settings_url' => '/core/user/user-profile/profile-settings.aspx',

        ]
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
