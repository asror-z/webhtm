<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * Date:    9/14/2019
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */


use zetsoft\dbdata\auth\RoleData;
use zetsoft\dbdata\eyuf\RoleAppData;

//use zetsoft\former\auth\LoginForm;
use zetsoft\former\auth\AuthLoginForm;
use zetsoft\former\auth\AuthPasswordRestoreForm;
use zetsoft\service\forms\Active;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZHTML;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\aZGrapesJsWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\iconers\ZAuthIconWidget;
use zetsoft\widgets\market\ZSVGWidget;
use zetsoft\widgets\notifier\ZKGrowlWidget;


/** @var ZView $this */
$restoreForm = new AuthPasswordRestoreForm();
$restoreForm->configs->nameOn = [
    'email'
];
$restoreForm->columns();

if ($this->formModel($restoreForm) === true) {
    if (Az::$app->cores->auth->sendForgetEmail($restoreForm->email)) {

        /*Az::$app->session->setFlash('Мы отправляем электронное письмо на ваш электронный адрес. Пожалуйста, проверьте свою электронную почту.');*/
        echo ZKGrowlWidget::widget([
            'config' => [
                'title' => Az::l('Отправлено!'),
                'delay' => 500,
                'type' => ZKGrowlWidget::type['success'],
                'body' => Az::l('Мы отправляем электронное письмо на ваш электронный адрес. Пожалуйста, проверьте свою электронную почту!'),
            ]
        ]);

        //$this->urlRefresh();
    }
    else
    {
        $this->urlRefresh();
    }
}


?>

<div class="d-flex justify-content-center align-items-center mb-5">
    <div class="col-md-10">

        <?php

        $active = new Active();
        $active->type = Active::type['horizontal'];
        $form = $this->activeBegin($active);

         ?>

        <div class="text-center d-flex justify-content-center">
            <h1 class="text-success mt-3 mb-5">
                <?php
/*                echo ZSVGWidget::widget()
                */

                echo App;
                ?>

            </h1>
        </div>

        <?php


        echo ZFormBuildWidget::widget([
            'model' => $restoreForm,
            'form' => $form,
            'config' => [
                'topBtn' => false,
                'botBtn' => false,
            ]
        ]);

        ?>
        <div class="d-flex justify-content-center">
            <div class="col-lg-7 col-md-9 mb-3">
                <?php
                echo ZHTML::submitButton(Az::l('<h6 class="m-0">Восстановление пароля</h6>'), ['class' => 'w-100 btn btn-success']);
                ?>
            </div>
        </div>
        <div class="flex-column align-items-center justify-content-center mb-0">
            <div class="justify-content-center">
                <!--<h3 class="text-center text-success"> Войти через </h3>-->
                <?


                /*echo ZAuthIconWidget::widget([
                ])*/
                ?>
            </div>
        </div>

        <?php $this->activeEnd(); ?>
    </div>
</div>


