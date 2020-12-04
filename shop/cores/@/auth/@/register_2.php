<?php

use yii\authclient\widgets\AuthChoice;
use yii\bootstrap4\Html;
use zetsoft\former\auth\AuthRegisterForm;
use zetsoft\models\user\User;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZHTML;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZFormWizardWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\widgets\themes\ZColWidget;
use zetsoft\widgets\themes\ZRowWidget;


/** @var ZView $this */
$action = new WebItem();

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

    Az::$app->cores->auth->login($user);
    Az::$app->cores->auth->defaultRole('scholar', $user);
    Az::$app->cores->auth->verify($user);

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

        $form = $this->activeBegin();

        ?>

        <div class="login-logo">
            <img src="/zetimg/<?=App?>/logo.jpg" alt="EYUF.UZ">
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

