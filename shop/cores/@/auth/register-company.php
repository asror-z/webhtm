<?php

use zetsoft\former\auth\AuthCompanyRegisterForm;
use zetsoft\models\user\User;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZHTML;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\iconers\ZAuthIconWidget;
use zetsoft\widgets\market\ZSVGWidget;



ob_start();

global $boot;
/** @var ZView $this */
$oathData = $this->sessionGet('oauthData');

$registerForm = new AuthCompanyRegisterForm();
$registerForm->configs->nameOn = [
    'email',
    'password',
    'role'
];
/** @var User $user */

if ($this->formModel($registerForm) === true) {
    $registerForm->role = 'market';
    Az::$app->cores->auth->register($registerForm);
    $this->urlRedirect(['/shop/company/main/create']);
}
?>

<div class="d-flex justify-content-center align-items-center">
    <div class="col-md-10">

        <?php $form = $this->activeBegin(); ?>
        <div class="text-center d-flex justify-content-center">
            <h1 class="text-success mb-5">
                <?php
                echo ZSVGWidget::widget()
                ?>
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
                echo ZHTML::submitButton(Az::l('<h6>РЕГИСТРАЦИЯ</h6>'), ['class' => 'w-100 btn btn-success']);
                ?>

            </div>
        </div>
        <div class="flex-column align-items-center justify-content-center">
        <div class="justify-content-center">
            <?
            if (!$oathData) {
                ?>
                <h3 class="text-center text-success mb-3"> Быстрый доступ с </h3>

                <?
                $icons = [
                    '/cores/auth/oauth.aspx?service=github' => ['git' => 'github'],
                    '/cores/auth/oauth.aspx?service=facebook' => ['fb' => 'facebook-f'],
                    '/cores/auth/oauth.aspx?service=twitter' => ['tw' => 'twitter'],
                    '/cores/auth/oauth.aspx?service=google-plus' => ['gplus' => 'google-plus-g'],
                    '/cores/auth/oauth.aspx?service=linked-in' => ['li' => 'linkedin-in'],
                ];
                echo ZAuthIconWidget::widget([
                    'data' => $icons
                ]);
            } ?>
        </div>
        </div>
        <?php $this->activeEnd(); ?>

    </div>

</div>
<?php return ob_get_clean() ?>
