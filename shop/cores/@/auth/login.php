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
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZHTML;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\iconers\ZAuthIconWidget;
use zetsoft\widgets\market\ZSVGWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\themes\ZCardWidget;


ob_start();


/** @var ZView $this */
$loginForm = new AuthLoginForm();

if ($this->formModel($loginForm) === true) {
    if (Az::$app->cores->auth->login($loginForm)) {
        $this->userIdentity();
        if ($this->hasRole('client'))
        {
            //$this->urlGetBack();
            $this->urlRedirect('/shop/user/main/index.aspx');
        }else{
            $this->urlRedirect('/shop/admin/core-product/index.aspx');
        }
    }
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

        <?php

        echo ZFormWidget::widget([
            'model' => $loginForm,
            'form' => $form,
            'config' => [
                'topBtn' => false,
                'botBtn' => false,
            ]
        ]);

        ?>
        <div class="d-flex justify-content-center">
            <div class="col-md-7 mb-5">
                    <?php
                    echo ZHTML::submitButton(Az::l('<h6>Вход в систему</h6>'), ['class' => 'w-100 btn btn-success']);
                    ?>
            </div>
        </div>
        <div class="flex-column align-items-center justify-content-center">
            <div class="justify-content-center">
                <h3 class="text-center text-success"> Войти через </h3>
                <?

                $icons = [
                    '/cores/auth/oauth.aspx?service=github' => ['git' => 'github'],
                    '/cores/auth/oauth.aspx?service=facebook' => ['fb' => 'facebook-f'],
                    '/cores/auth/oauth.aspx?service=twitter' => ['tw' => 'twitter'],
                    '/cores/auth/oauth.aspx?service=google-plus' => ['gplus' => 'google-plus-g'],
                    '/cores/auth/oauth.aspx?service=linked-in' => ['li' => 'linkedin-in'],
                ];
                echo ZAuthIconWidget::widget([
                    'data' => $icons,
                ])
                ?>
            </div>
        </div>

        <?php $this->activeEnd(); ?>
    </div>
</div>


<?php
return ob_get_clean();
?>
