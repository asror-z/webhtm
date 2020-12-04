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
use zetsoft\widgets\themes\ZSignUpWidgetNew;





    echo ZSignUpWidgetNew::widget([

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
