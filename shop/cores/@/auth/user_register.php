<?php

use yii\authclient\widgets\AuthChoice as AuthChoiceAlias;
use yii\bootstrap4\Html;

use zetsoft\former\auth\AuthRegisterForm;
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
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\widgets\themes\ZColWidget;
use zetsoft\widgets\themes\ZRowWidget;


/** @var ZView $this */
$oathData = $this->sessionGet('oauthData');
$action->title = Azl . 'Регистрация';

$model = new AuthRegisterForm();

$action->icon =false;
$action->type = WebItem::type['html'];

$model->configs->nameOn = [
    'email',
    'password',
    'role'

];
/** @var User $user */

if ($this->formModel($model) === true) {
    ///Az::$app->cores->auth->defaultRole($model, 'consumer');
    $model->role = 'client';
    if(Az::$app->cores->auth->register($model)){
        $url = ZUrl::to($boot->env('redirectAfterRegister'));
        return $this->urlRedirect($url);
    }

//    Az::$app->cores->auth->verify($model);

    /** @var EyufScholar $scholar */

//    if (Az::$app->App->eyuf->main->scholarSave($model)) {
//        $this->urlRedirect(['/logics/scholar/add-info']);
//    } else
//        return $this->alertDanger( $model->attributes, Az::l('Проверка регистрации'));


}


?>


<div class=" justify-content-center container">
    <div class="col-md-12 p-4 ">

        <?php

        /*ZCardWidget::begin([
            'config' => [
                'title' => $this->title,
                'isHeader' => false,
                'cardTitleBool' => false,
                'footerBool' => false,
                'cardBottomBtnBool' => false,
                'mytheme' => 'reg-rad0',

            ]
        ]);*/

        $form = $this->activeBegin();

        ?>
        <div class="login-logo">
            <a href="/" target="_blank">
                <?php
                echo Az::l('РЕГИСТРАЦИЯ')
                ?>
            </a>
        </div>
        <?
        echo ZFormWidget::widget([
            'model' => $model,
            'form' => $form,
            'config' => [
                'topBtn' => false,
                'botBtn' => false,
            ],
        ]);
        ?>
        <div class="row justify-content-center">
            <div class="justify-content-center">
                <?
                if (!$oathData) {
                    ?>
                    <h1 class="text-center text-success"> Войти через </h1>

                    <?
                    echo zetsoft\widgets\navigat\ZButtonWidget::widget([
                        'config' => [
                            'hasIcon' => true,
                            'btnType' => ZButtonWidget::btnType['link'],
                            'btnRounded' => false,
                            'btnFloating' => true,
                            'icon' => 'fab fa-github',
                            //'title' => 'Перейти на главную',
                            'color' => ZColor::gradient['mean-fruit-gradient'],
                            'url' => '/cores/auth/oauth.aspx?service=github',
                            'blank' => false,
                            'target' => ZButtonWidget::target['_self'],
                            'iconColor' => '#ffffff',
                            'title' => 'github'
                        ],
                    ]);
                    echo zetsoft\widgets\navigat\ZButtonWidget::widget([
                        'config' => [
                            'hasIcon' => true,
                            'btnType' => ZButtonWidget::btnType['link'],
                            'btnRounded' => false,
                            'btnFloating' => true,
                            'icon' => 'fab fa-google-plus-g',
                            //'title' => 'Перейти на главную',
                            'color' => ZColor::gradient['aqua-gradient'],
                            'url' => '/core/tester/sunnat/oauth.aspx?service=google&metka=signin',
                            'blank' => true,
                            'target' => ZButtonWidget::target['_self'],
                            'iconColor' => '#ffffff',
                            'title' => 'google'
                        ],
                    ]);
                    echo zetsoft\widgets\navigat\ZButtonWidget::widget([
                        'config' => [
                            'hasIcon' => true,
                            'btnType' => ZButtonWidget::btnType['link'],
                            'btnRounded' => false,
                            'btnFloating' => true,
                            'icon' => 'fab fa-yandex',
                            //'title' => 'Перейти на главную',
                            'color' => ZColor::gradient['winter-neva-gradient'],
                            'url' => '/core/tester/sunnat/oauth.aspx?service=yandex&metka=signin',
                            'blank' => true,
                            'target' => ZButtonWidget::target['_self'],
                            'iconColor' => '#000',
                            'title' => 'yandex'
                        ],
                    ]);
                    echo zetsoft\widgets\navigat\ZButtonWidget::widget([
                        'config' => [
                            'hasIcon' => true,
                            'btnType' => ZButtonWidget::btnType['link'],
                            'btnRounded' => false,
                            'btnFloating' => true,
                            'icon' => 'fab fa-facebook-f',
                            //'title' => 'Перейти на главную',
                            'color' => ZColor::gradient['night-fade-gradient'],
                            'url' => '/core/tester/sunnat/oauth.aspx?service=facebook&metka=signin',
                            'blank' => true,
                            'target' => ZButtonWidget::target['_self'],
                            'iconColor' => '#ffffff',
                            'title' => 'facebook'
                        ],
                    ]);
                    echo zetsoft\widgets\navigat\ZButtonWidget::widget([
                        'config' => [
                            'hasIcon' => true,
                            'btnType' => ZButtonWidget::btnType['link'],
                            'btnRounded' => false,
                            'btnFloating' => true,
                            'icon' => 'fab fa-instagram',
                            //'title' => 'Перейти на главную',
                            'color' => ZColor::gradient['peach-gradient'],
                            'url' => '/core/tester/sunnat/oauth.aspx?service=instagram&metka=signin',
                            'blank' => true,
                            'target' => ZButtonWidget::target['_self'],
                            'iconColor' => '#ffffff',
                            'title' => 'instagram'
                        ],
                    ]);
                } ?>
            </div>
        </div>
        <div class="row d-flex justify-content-center mt-4">
            <div class="col-10 d-flex justify-content-center">
                <?php
                echo ZHTML::submitButton(Az::l('Submit'),
                    [
                        'class' => 'btn btn-success'
                    ]);
                ?>
            </div>

        </div>

        <!--        <div class="row">-->
        <!--            <div>-->
        <!--                --><?php
        //                //-----------------------------
        //                //My Work
        //                echo yii\authclient\widgets\AuthChoice::widget([
        //                    'baseAuthUrl' => ['cores/auth/register'],
        //                    'popupMode' => false,
        //                ]);
        //
        //
        //                //------------------------------
        //                ?>
        <!--            </div>-->
        <!--        </div>-->


        <?php
        $this->activeEnd();

        ?>

    </div>
</div>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Marck+Script&display=swap');

    @font-face {
        font-family: 'Marck Script', cursive;
        font-style: normal;
    }

    .login-logo a {
        font-family: 'Marck Script', cursive;
        font-size: 50px;
        color: #10b410;
    }
</style>
