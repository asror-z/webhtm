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
use zetsoft\service\forms\Active;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZHTML;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\iconers\ZAuthIconWidget;
use zetsoft\widgets\market\ZSVGWidget;


/** @var ZView $this */
$loginForm = new AuthLoginForm();

if ($this->formModel($loginForm) === true) {

    if ($return = Az::$app->cores->auth->login($loginForm)) {
        if ($return === 'NeedEmail') {
            return $this->urlRedirect($this->bootEnv('verifyMailUrl'));
        }
        if ($return === 'NeedPhone') {
            return $this->urlRedirect($this->bootEnv('verifyPhoneUrl'));
        }

        $this->urlRedirectAll();

    }
}

if (!$this->userIsGuest())
    $this->urlRedirectAll();


?>

<style>

</style>

<div class="d-flex mt-5 justify-content-center align-items-center mb-5">
    <div class="col-md-12">

        <?php $active = new Active();
        $active->type = Active::type['horizontal'];
        $form = $this->activeBegin($active);

        ?>

        <?php

        echo ZFormBuildWidget::widget([
            'model' => $loginForm,
            'form' => $form,
            'config' => [
                'topBtn' => false,
                'botBtn' => false,
            ]
        ]);

        ?>
        <div class="d-flex justify-content-center">
            <div class="col-lg-8 col-md-9 mb-3 mt-5">
                <?php
                echo ZHTML::submitButton('<h6 class="m-0">' . Az::l('Вход в систему') . '</h6>', ['class' => 'w-100 btn btn-primary btn2 shadow-none']);
                ?>

                <div class="text-right text-white">

                    <?
                    echo ZHTML::a(Az::l('<h6 class="m-0 text-center">Забыли пароль?</h6>'), ZUrl::to(['/core/restoreEmail/password_res']));
                    ?>
                </div>

            </div>
        </div>
        <div class="flex-column align-items-center justify-content-center mb-0 mt-3">
            <div class="justify-content-center">
                <h3 class="text-center text-white"> Войти через </h3>
                <?

                echo ZAuthIconWidget::widget([

                ])

                ?>
            </div>
        </div>

        <?php $this->activeEnd(); ?>
    </div>
</div>


