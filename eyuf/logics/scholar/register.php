<?php


use zetsoft\dbitem\core\WebItem;
use zetsoft\former\auth\AuthRegisterForm;
use zetsoft\models\App\eyuf\EyufScholar;
use zetsoft\service\forms\Active;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZHTML;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZFormWidget;


/** @var ZView $this */


$action = new WebItem();

$action->title = Azl . 'Регистрация в интранет системе EYUF';
$action->icon = 'fal fa-print';


$action->layout = true; $action->debug = false;
$action->layoutFile = 'login';
$action->cache = false;

$action->call = null;

$model = new AuthRegisterForm();

if ($this->formModel($model) === true) {

	$scholar = EyufScholar::find()
		->where([
			'email' => $model->email,
		])
		->limit(1)
		->one();

	$mail_check = \zetsoft\models\user\User::find()
		->where([
			'email' => $model->email,
		])
		->limit(1)
		->one();

	if ($mail_check !== null)
		$this->urlRedirect(['/cores/auth/user-check']);
	else {
		if ($scholar !== null) {

			$user = new \zetsoft\models\user\User();
			$user->phone = $scholar->phone;
			$user->name = $scholar->name;
			$user->email = $scholar->email;
			$user->password = $model->password;

			$user->configs->rulesAll = [
				[validatorSafe]
			];

			if ($user->save()) {

				$scholar->user_id = $user->id;
				$scholar->save();

				$this->cores->auth->login($user);
				$this->cores->auth->defaultRole($user, 'scholar');
				$this->cores->auth->verify($user);

				$this->urlRedirect(['/logics/scholar/add-info']);
			}
		} else {
			return $this->alertWarning(Az::l('Стипендиант не найден'), $this->userIdentity()->id);
		}

	}
}


?>


<div class="row d-flex justify-content-center">
    <div class="col-md-12 p-4 text-center">
        <?php

        $active = new Active();
        $active->type = Active::type['horizontal'];
        $form = $this->activeBegin($active);


        ?>

        <div class="login-logo">
            <a href="/" target="_blank">
                <img src="/render/asrorz/images/logo.jpg" alt="ZCore.uz">
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
                <?php
                echo ZHTML::submitButton(Az::l('Регистрация'),
                    [
                        'class' => 'btn btn-primary'
                    ]);
                ?>
            </div>
        </div>

        <?php $this->activeEnd(); ?>
    </div>
</div>

