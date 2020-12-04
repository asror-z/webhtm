<?php

use yii\helpers\Json;
use zetsoft\former\auth\AuthRegisterForm;
use zetsoft\models\user\User;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZHTML;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\navigat\ButtonWidget;
use zetsoft\widgets\themes\ZCardWidget;
use yii\authclient\widgets\AuthChoice;
use yii\bootstrap4\Html;

/**
 * @var ZView $this
 */
?>



<?php

$model = new AuthRegisterForm();

$service = '';
$custom_field = '';


$model = Az::$app->cores->auth->fillRegisterModel($model);

if (Az::$app->forms->modelz->form($model) === true) {
    if (!empty($service) && !empty($custom_field)) {
        if (User::findOne([
                $service => $custom_field
            ]) !== null) {
            $this->urlRedirect(['core/login']);
        }
    }

    if (Az::$app->cores->auth->register($model)) {
        $user = Az::$app->cores->auth->user($model->name);
        Az::$app->cores->auth->login($model, $user);
        $this->urlRedirect('/');
    }
}

?>

<div class="row justify-content-center">
    <div class="col-md-8 p-4">
        <?php

        $this->title = Az::l("Регистрация в системе ") . $boot->env('appTitle');


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

        // @TODO: add class to body div -> "login-card-body"

        $form = $this->activeBegin();
        ?>
        <div class="login-logo">
            <a href="/" target="_blank">
                <img src="/zetimg/<?=App?>/logo.jpg" alt="ZCore.uz">
            </a>
        </div>

        <?php

        echo ZFormWidget::widget([
            'model' => $model,
            'form' => $form,
            'config' => [
                'submitBtn' => false
            ],

        ]);

        echo ZHTML::submitButton(Az::l('Регистрация'), ['class' => 'btn btn-primary']);

        ?>

        <div class="social-auth-links text-center mb-3"><p>- или -</p>
            <?php $authAuthChoice = AuthChoice::begin([
                'baseAuthUrl' => ['core/auth']
            ]); ?>

            <ul class="auth-clients">
                <?php foreach ($authAuthChoice->getClients() as $client): ?>
                    <li><?= $authAuthChoice->clientLink($client, '<i class="fab fa-' . $client->getName() . ' fa-2x  text-primary"></i>', [
                            'class' => $client->getName(),
                        ]) ?></li>
                <?php endforeach; ?>
            </ul>

            <?php AuthChoice::end(); ?>
        </div>

        <p class="mb-1">
            <?= Html::a(Az::l('Забыли пароль?'), '#') ?>
        </p>
        <p class="mb-0">
            <?= Html::a(Az::l('Уже есть аккаунт'), ['/core/core/login']) ?>
        </p>

        <?php
        $form = $this->activeEnd();
        ZCardWidget::end();
        ?>

    </div>
</div>



