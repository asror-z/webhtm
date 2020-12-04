<?php

use yii\authclient\widgets\AuthChoice;
use yii\bootstrap4\Html;
use zetsoft\former\auth\AuthLoginForm;
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


ZRowWidget::begin();

ZColWidget::begin([
    'config' => [
        'width' => 3
    ]
]);

ZColWidget::end();

ZColWidget::begin([
    'config' => [
        'width' => 6
    ]
]);


$model = new LoginForm();

$this->forms->active->enableLabel = true;
$active = new Active();
$active->type = Active::type['horizontal'];
$form = $this->activeBegin($active);
$this->forms->model->form($model);
$this->forms->model->post();

$this->title = Az::l("Вход в систему ") . $this->cores->boot->env('appName');


ZCardWidget::begin([
    'config' => [
        'title' => $this->title
    ]
]);


?>
<div class="login-logo">
    <a href="/" target="_blank">
        <img src="/image/logo.jpg" alt="ZCore.uz">
    </a>
</div>
<div class="form_text_bold">
    <?

    echo ZFormWidget::widget([
        'model' => $model,
        'form' => $form,
        // 'nameOn' => [],
        'config' => [
            'submitBtn' => false
        ],
    ]);
    ?>
</div>
<div class="btn-login-submit">
    <?= ZHTML::submitButton('Log In', ['class' => 'btn btn-primary text-center btn-login-submit']); ?>
</div>


<div class="social-auth-links text-center mb-4 "><p>- или -</p>
    <?php $authAuthChoice = AuthChoice::begin([
        'baseAuthUrl' => ['core/auth']
    ]); ?>
    <div class="auth-choise">
        <ul class="auth-clients">
            <?php foreach ($authAuthChoice->getClients() as $client): ?>
                <li><?= $authAuthChoice->clientLink($client, '<i class="fab fa-' . $client->getName() . ' fa-2x "></i>', [
                        'class' => $client->getName(),
                    ]) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php AuthChoice::end(); ?>
</div>


<div class="form-group">
    <a>
        <?= Html::a(Az::l('Забыли пароль?'), '#', ['class' => 'btn btn-outline-info']) ?>
    </a>
    <a>
        <?= Html::a(Az::l('Зарегистрироваться'), ['/kernel/core/register'],
            ['class' => 'btn btn-outline-info']) ?>
    </a>
</div>

<?


ZCardWidget::end();

$this->activeEnd();


ZColWidget::end();

ZColWidget::begin([
    'config' => [
        'width' => 3
    ]
]);

ZColWidget::end();
ZRowWidget::end();


?>
