<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\former\auth\AuthEyufRegisterForm;
use zetsoft\former\auth\AuthRegisterForm;
use zetsoft\models\user\User;
use zetsoft\service\forms\Active;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZHTML;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZFormWidget;


/** @var ZView $this */

$action = new WebItem();

$action->title = Azl . 'Регистрация в интранет системе EYUF';
$action->icon = 'fa fa-globe';

$action->csrf = true;
$action->debug = false;
$action->layout = true; $action->debug = false;
$action->layoutFile = 'login2';


$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

/*
$model = new \zetsoft\models\user\User();

$model->configs->nameOn = [
    'title',
    'email',
    'sex',
    'phone',
    'password',
];
$model->columns();*/

/** @var User $user */

/*
if ($this->modelSave($model)) {

    Az::$app->cores->auth->login($model);

    Az::$app->cores->auth->defaultRole($model, 'scholar');
    Az::$app->cores->auth->verify($model);

    if (Az::$app->App->eyuf->main->EyufScholarSave($model)) {
        $this->urlRedirect(['/eyuf/logics/scholar/add-info']);
    } else
        return $this->alertDanger( $model->attributes, Az::l('Проверка регистрации'));


}*/

/** @var ZView $this */
$oathData = $this->sessionGet('oauthData');

$registerForm = new AuthEyufRegisterForm();

$registerForm->configs->titles = [
    'login'  => 'E-mail'
];
$registerForm->configs->nameOn = [
    'login',
    'password',
    'role'
];
$registerForm->columns();
/** @var User $user */
global $boot;

if ($this->formModel($registerForm) === true) {
    $registerForm->role = 'scholar';

    if (Az::$app->cores->auth->register($registerForm)) {

        /* $user = $this->userIdentity();
         $scholar = new EyufScholar();
         $scholar->email = $user->email;
         $scholar->name = $user->name;
         $scholar->user_id = $user->id;
         $scholar->configs->rules = [
             [validatorSafe]
         ];
         $scholar->save();*/

        $this->paramSet(paramIframe, true);

        switch (true) {
            case Az::$app->cores->auth->isPhone($registerForm->login) && $boot->env('verify'):
                return $this->urlRedirect('/cpas/user/user-auth/verify/verify-phone.aspx');
                break;
            case $boot->env('verify') && Az::$app->cores->auth->isEmail($registerForm->login):
                return $this->urlRedirect('/core/user/verify/verify.aspx');
                break;
            case $returnUrl = $this->httpGet('returnUrl'):
                $this->urlRedirect($returnUrl, false);
                break;
            default:
                $this->urlRedirect($this->bootEnv('urlHome'), false);
        }

    }

}
?>

<div class="row justify-content-center">
    <div class="col-md-12 p-4 ">

        <?php
        $active = new Active();
        $active->type = Active::type['horizontal'];
        $form = $this->activeBegin($active);
        ?>

        <div class="login-logo text-center">
            <a href="/" target="_blank">
                <img src="/render/asrorz/images/logo.jpg" alt="ZCore.uz">
            </a>
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
        <div class="row d-flex justify-content-center mt-4">
            <div class="col-10 d-flex justify-content-center">
                <?php
                echo ZHTML::submitButton(Az::l('Регистрация'),
                    [
                        'class' => 'btn btn-primary'
                    ]);
                ?>
            </div>

        </div>
    </div>

    <?php
    $this->activeEnd();



    ?>

</div>
