<?php

use yii\authclient\widgets\AuthChoice as AuthChoiceAlias;
use yii\bootstrap4\Html;
use yii\debug\Module;
use zetsoft\former\auth\AuthRegisterForm;
use zetsoft\models\user\User;
use zetsoft\models\App\eyuf\EyufScholar;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZHTML;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZFormWizardWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\iconers\ZAuthIconWidget;
use zetsoft\widgets\market\ZSVGWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\widgets\themes\ZColWidget;
use zetsoft\widgets\themes\ZRowWidget;


ob_start();

global $boot;
/** @var ZView $this */
$oathData = $this->sessionGet('oauthData');


$registerForm = new AuthRegisterForm();
$registerForm->configs->nameOn = [
    'email',
    'password',
    'role'

];
/** @var User $user */

if ($this->formModel($registerForm) === true) {
    $registerForm->role = 'client';
    Az::$app->cores->auth->register($registerForm);

    if (Az::$app->cores->auth->register($registerForm)) {
        if ($boot->env('verifyEmail')) {
            $url = ZUrl::to($boot->env('redirectAfterRegister'));
            //return $this->urlRedirect($url);
           /// vdd("asdfasdf");
            $this->urlRedirect('/shop/bozor/main/index.aspx');
        }
    }

}
?>

<div class="d-flex justify-content-center align-items-center">
    <div class="col-md-10">

        <?php

        $form = $this->activeBegin();

        ?>
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
        <div class="">
            <div class="">
                <?
                if (!$oathData) {
                    ?>
                    <h3 class="text-center text-success"> Быстрый доступ с </h3>

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


        <?php
        $this->activeEnd();

        ?>

    </div>
</div>
<?php return ob_get_clean() ?>
