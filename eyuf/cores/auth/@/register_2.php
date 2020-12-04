<?php

use yii\authclient\widgets\AuthChoice;
use yii\bootstrap4\Html;
use zetsoft\former\ALL\RegisterForm;
use zetsoft\models\user\User;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZHTML;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\widgets\themes\ZColWidget;
use zetsoft\widgets\themes\ZRowWidget;


/** @var ZView $this */
$action = new WebItem();

$action->layout = true; $action->debug = false;
$action->icon = 'fa fa-graduation-cap';


$action->title = Azl . 'Регистрация в интранет системе EYUF';


$model = new User();

$model->configs->nameOn = [
    'name',
    'title',
    'email',
    'password',
];

/** @var User $user */
if ($user = $this->modelSave($model)) {

    $this->cores->auth->login($user);
    $this->cores->auth->defaultRole('scholar', $user);
    $this->cores->auth->verify($user);

    $this->urlRedirect('/');

}

?>

<div class="row justify-content-center">
    <div class="col-md-12 p-4">
        <?php

        ZCardWidget::begin([
            'config' => [
                'title' => $this->title,
                'isHeader' => false,
                'cardTitleBool' => false,
                'footerBool' => false,
                'cardBottomBtnBool' => false,
                'mytheme' => 'reg-rad0',

            ]
        ]);

        $active = new Active();
$active->type = Active::type['horizontal'];
$form = $this->activeBegin($active);

        ?>

        <div class="login-logo">
            <img src="/image/logo.jpg" alt="EYUF.UZ">
        </div>

        <?

        echo ZFormWidget::widget([
            'model' => $model,
            'form' => $form,
            'config' => [
                'submitBtn' => false
            ],
        ]);

        echo ZHTML::submitButton(Az::l('Регистрация'), ['class' => 'btn btn-primary']);
        
        echo ZButtonWidget::widget([
            'config' => [
                'btnType' => ZButtonWidget::btnType['button'],
                'text' => Az::l('Вход в систему'),
                'hasIcon' => false,
                'btnStyle' => ZButtonWidget::btnStyle['btn-primary'],
                'class' => 'text-white',
                'btnRounded' => false,

            ],
        ]);
        
        $this->activeEnd();

        ZCardWidget::end();


        require 'login.php';
        ?>
    </div>
</div>

