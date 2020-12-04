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
use zetsoft\models\ALL\CoreRole;
use zetsoft\models\user\User;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZHTML;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\themes\ZCardWidget;

$this->cores->auth->checkUser();
?>

<?php


$model = new LoginForm();

if ($this->forms->model->form($model) === true) {

    $user = $this->cores->auth->user($model->name);

    if ($this->cores->auth->login($user)) {

        $this->notifyInfo("Добро пожаловать в <b>{$this->cores->boot->env('appName')}}</b>", "Здравствуйте Уважаемый <b>{$this->cores->auth->identity->title}</b>!");

        switch ($user->userRole()) {
            case 'admin':

                break;

            default:
                return $this->urlRedirect('/mains/profile/verst.aspx');
                break;
        }


    }
}

?>

<div class="row justify-content-center">
    <div class="col-md-10 p-4">

        <?php


        /** @var ZView $this */
        //$model = $this->modelGet(Computer::class, 66);

        $active = new Active();
$active->type = Active::type['horizontal'];
$form = $this->activeBegin($active);


        ZCardWidget::begin([
            'config' => [
                'type' => ZCardWidget::type['unShadow'],
                'title' => 'Login'
            ]
        ]);

        ?>

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
                'submitBtn' => false
            ]
        ]);
        ?>
        <div class="row d-flex justify-content-center mt-4">
            <!--            <div class="col-4"></div>-->
            <div class="col-10 d-flex justify-content-center">
                <?php
                echo ZHTML::submitButton(Az::l('Вход в систему'), ['class' => 'btn btn-primary']);
                ?>
            </div>

        </div>

        <?php
        ZCardWidget::end();
        $this->activeEnd();
        ?>
    </div>
</div>
