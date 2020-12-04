<?php

//use zetsoft\former\auth\AuthRegisterForm;
use zetsoft\former\auth\AuthRegisterForm;
use zetsoft\models\user\User;
use zetsoft\service\forms\Active;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZHTML;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\iconers\ZAuthIconWidget;
use zetsoft\widgets\market\ZSVGWidget;


global $boot;
/** @var ZView $this */
$oathData = $this->sessionGet('oauthData');


$registerForm = new AuthRegisterForm();
$registerForm->configs->nameOn = [
    'login',
    'password',
    'role'
];
/** @var User $user */
global $boot;

if ($this->formModel($registerForm) === true) {
    $registerForm->role = 'client';
    if (Az::$app->cores->auth->sendForgetEmail($to, $verify_code)) {
        return $this->urlRedirect('/cpas/user/forget/forget.aspx');
    }

}


?>

<div class="d-flex justify-content-center align-items-center">
    <div class="col-md-10">

        <?php
        $active = new Active();
        $active->formAction = '#tab-2';
        $form = $this->activeBegin($active);

        ?>
        <div class="text-center d-flex justify-content-center">
            <h1 class="text-success mt-3 mb-5">
                <?php
                /*                echo ZSVGWidget::widget()
                                */ ?>
                Arbit Pro
            </h1>
        </div>
        <?
        echo ZFormWidget::widget([
            'model' => $registerForm,
            'form' => $form,
            'config' => [
                'topBtn' => false,
                'botBtn' => false,
            ],
        ]);
        ?>
        <div class="d-flex justify-content-center">
            <div class="col-md-7 mb-5">
                <?php
                echo ZHTML::submitButton(Az::l('<h6 class="m-0">РЕГИСТРАЦИЯ</h6>'), ['class' => 'w-100 btn btn-success']);
                ?>

            </div>
        </div>
        <div class="">
            <div class="">
                <?
                /* if (!$oathData) {
                     */ ?><!--
                    <h3 class="text-center text-success"> Быстрый доступ с </h3>

                    --><? /*
                    echo ZAuthIconWidget::widget([
                    ]);
                }*/ ?>
            </div>
        </div>


        <?php
        $this->activeEnd();

        ?>

    </div>
</div>

