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


use zetsoft\dbdata\auth\RoleData;
use zetsoft\dbdata\eyuf\RoleAppData;

//use zetsoft\former\auth\LoginForm;
use zetsoft\former\auth\AuthLoginForm;
use zetsoft\former\auth\AuthPasswordRestoreForm;
use zetsoft\service\forms\Active;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZHTML;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\iconers\ZAuthIconWidget;
use zetsoft\widgets\market\ZSVGWidget;

$code = $this->httpGet('code');

$user = \zetsoft\models\user\User::find()
    ->where([
        'verify_code' => $code
    ])
    ->one();

if ($user){


/** @var ZView $this */

$restoreForm = new AuthPasswordRestoreForm();
$restoreForm->configs->nameOn = [
    'password',
    're_password'
];
$restoreForm->columns();

if ($this->formModel($restoreForm) === true) {
    if (Az::$app->cores->auth->restorePassword($code,$restoreForm->password)) {

            switch ($user->role) {
                case 'admin':
                    $this->urlRedirect('/cpas/admin/statistic.aspx');
                    break;

                case 'client':
                    $this->urlRedirect('/cpas/client/statistic.aspx');
                    break;
            }
        
    }
    else
    {
        $this->urlRefresh();
    }
}


?>

<div class="d-flex justify-content-center align-items-center mb-5">
    <div class="col-md-10">

        <?php

        $active = new Active();
        $active->type = Active::type['horizontal'];
        $form = $this->activeBegin($active);

         ?>

        <div class="text-center d-flex justify-content-center">
            <h1 class="text-success mt-3 mb-5">
                <?php
/*                echo ZSVGWidget::widget()
                */?>
                Arbit Pro
            </h1>
        </div>

        <?php


        echo ZFormBuildWidget::widget([
            'model' => $restoreForm,
            'form' => $form,
            'config' => [
                'topBtn' => false,
                'botBtn' => false,
            ]
        ]);

        ?>
        <div class="d-flex justify-content-center">
            <div class="col-lg-7 col-md-9 mb-3">
                <?php
                echo ZHTML::submitButton(Az::l('<h6 class="m-0">Восстановление пароля</h6>'), ['class' => 'w-100 btn btn-success']);
                ?>
            </div>
        </div>
        <div class="flex-column align-items-center justify-content-center mb-0">
            <div class="justify-content-center">
                <!--<h3 class="text-center text-success"> Войти через </h3>-->
                <?


                /*echo ZAuthIconWidget::widget([
                ])*/
                ?>
            </div>
        </div>

        <?php $this->activeEnd(); ?>
    </div>
</div>
<?php

}

else{
  ?>

    <div class="d-flex justify-content-center align-items-center mb-5">
        <div class="col-md-10">



            <div class="text-center d-flex justify-content-center">
                <h1 class="text-success mt-3 mb-5">
                    <?= Az::l('Пожалуйста, попробуйте позже')?>
                </h1>
            </div>



        </div>
    </div>
<?php

}
?>

