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


use yii\authclient\widgets\AuthChoice;
use yii\bootstrap4\Html;
use zetsoft\former\auth\AuthLoginForm;
use zetsoft\models\user\User;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZHTML;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\themes\ZCardWidget;

$action->title = Azl . 'Вход в систему';

$action->icon =false;
$this->type = ZView::type['html'];


/** @var ZView $this */
$model = new LoginForm();

if ($this->formModel($model) === true) {
    $user = $this->cores->auth->user($model->email);

    if ($this->cores->auth->login($user)) {
        $this->notifyInfo(Az::l("Добро пожаловать в платформу Eyuf интранет</br>"), "Здравствуйте Уважаемый <b>{$this->userIdentity()->name}</b>!");

        $role = $user->userRole();

        switch ($role) {
            case 'scholar':
                $url = $this->bootEnv('urlScholarIndex');
                return $this->urlRedirect([$url]);
                break;

            default;
                return $this->urlRedirect(["/logics/$role/index"]);
        }
    }
}
?>

<div class="row justify-content-center">
    <div class="col-md-10 p-4">

        <?php $active = new Active();
$active->type = Active::type['horizontal'];
$form = $this->activeBegin($active); ?>

        <div class="login-logo">
            <a href="/" target="_blank">
                <img src="/image/logo.jpg" alt="ZCore.uz">
            </a>
        </div>

        <?php

        echo ZFormWidget::widget([
            'model' => $model,
            'form' => $form,
            'config' => [
                'topBtn' => false,
                'botBtn' => false,
            ]
        ]);

        ?>
        <div class="row d-flex justify-content-center mt-4">

            <div class="col-10 d-flex justify-content-center">
                <?php
                echo ZHTML::submitButton(Az::l('Вход в систему'),
                    [
                        'class' => 'btn btn-primary'
                    ]);
                ?>
            </div>
        </div>
        <?php $this->activeEnd(); ?>
    </div>
</div>

<a href='/tester/sunnat/oauthgithub.aspx'> Sign In GitHub </a>
