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
use zetsoft\dbitem\core\WebItem;
use zetsoft\service\forms\Active;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZHTML;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZFormWidget;

$action = new WebItem();

$action->title = Azl . 'Вход в систему';
$action->icon = 'fal fa-print';

$action->debug = false;
$action->layout = true;
$action->debug = false;
$action->layoutFile = 'login2';
$action->cache = false;
$action->call = null;
$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();
/** @var ZView $this */
$model = new \zetsoft\former\auth\AuthLoginForm();

$model->configs->titles = [
    'login' => 'E-mail'
];
$model->columns();
if ($this->formModel($model) === true) {
    $user = Az::$app->cores->auth->user();

    if ($return = Az::$app->cores->auth->login($model)) {

     
        if ($return === 'NeedEmail') {
            return $this->urlRedirect($this->bootEnv('verifyMailUrl'));
        }

        if ($return === 'NeedPhone') {
            return $this->urlRedirect($this->bootEnv('verifyPhoneUrl'));
        }

        if ($this->httpGet('returnUrl')) {
            return $this->urlRedirectReturn();
        }

        $url = new RoleData;
        $menu = $url->menu();

        $this->urlRedirect($menu[$this->userIdentity()->role]);
    
    }
}
?>

<div class="row justify-content-center">
  <div class="col-md-10 p-4">

      <?php $active = new Active();
      $active->type = Active::type['horizontal'];
      $form = $this->activeBegin($active); ?>

    <div class="login-logo text-center">
      <a href="/" target="_blank">
        <img src="/render/asrorz/images/logo.jpg" alt="ZCore.uz">
      </a>
    </div>

      <?php

      echo ZFormWidget::widget([
          'model' => $model,
          'form' => $form,
          'config' => [
              'topBtn' => false,
              'botBtn' => false,
          ]
      ]);

      ?>
    <div class="row d-flex justify-content-center mt-4">

      <div class="col-10 d-flex justify-content-center">
          <?php
          echo ZHTML::submitButton(Az::l('Вход в систему'),
              [
                  'class' => 'btn btn-primary'
              ]);
          ?>
      </div>
    </div>
      <?php $this->activeEnd(); ?>
  </div>
</div>
