<?php

use yii\authclient\widgets\AuthChoice as AuthChoiceAlias;
use yii\bootstrap4\Html;

use zetsoft\former\auth\AuthRegisterForm;
use zetsoft\models\user\User;
use zetsoft\models\App\eyuf\EyufScholar;
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

$action->title = Azl . 'Регистрация в интранет системе EYUF';

$model = new AuthRegisterForm();

$action->icon =false;
$action->type = WebItem::type['html'];

$model->configs->nameOn = [
    'name',
    'email',

];

/** @var User $user */

if ($this->formModel($model) === true) {

    Az::$app->cores->auth->login($model);
    $this->urlRedirect($this->urlGetBase());
//    Az::$app->cores->auth->defaultRole($model, 'scholar');
//    Az::$app->cores->auth->verify($model);

    /** @var EyufScholar $scholar */

//    if (Az::$app->App->eyuf->main->scholarSave($model)) {
//        $this->urlRedirect(['/logics/scholar/add-info']);
//    } else
//        return $this->alertDanger( $model->attributes, Az::l('Проверка регистрации'));


}

?>


<div class="row justify-content-center">
    <div class="col-md-12 p-4 ">
        <?php $form = $this->activeBegin(); ?>
        <div class="login-logo">
            <a href="/" target="_blank">
                <img src="/zetimg/<?= App ?>/eyu-1.jpg" alt="ZCore.uz">
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
        <div class="row d-flex justify-content-center mt-4">
            <div class="col-10 d-flex justify-content-center">
                <?= ZHTML::submitButton(Az::l('User'), ['class' => 'btn btn-primary']); ?>
            </div>
        </div>
        <?php $this->activeEnd(); ?>
    </div>
</div>

