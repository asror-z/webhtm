<?php

use zetsoft\dbitem\App\eyuf\RecaptchaItem;
use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\data\TabItem;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\actions\ZRecaptchaWidget;
use zetsoft\widgets\actions\ZRecaptchaWidgetX1;
use zetsoft\widgets\actions\ZRecaptchaWidget1;
use zetsoft\widgets\actions\ZRecaptchaWidgetX;
use zetsoft\widgets\incores\ZMCheckboxWidget;
use zetsoft\widgets\incores\ZMCheckboxWidget3;
use zetsoft\widgets\inputes\ZCheckboxGroupWidget;
use zetsoft\widgets\market\ZFooterAllWidgetOrg;
use zetsoft\widgets\themes\ZTabWidget;


/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Вход | Регистрация';
$action->icon = 'fa fa-area-chart';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;



$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

/** @var ZView $this */
$this->beginPage();

$returnUrl = $this->httpGet('returnUrl');

?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>

    <?php

    require(Root . '/webhtm/block/metas/main.php');
    require(Root . '/webhtm/block/assets/App/main_arbit.php');


    $this->head();

    ?>

</head>
<style>
    .login-back {
        background: rgb(0, 0, 0);
        background: linear-gradient(52deg, rgba(0, 0, 0, 1) 35%, rgba(0, 0, 0, 1) 35%, rgba(1, 70, 1, 1) 95%);
        min-height: 700px;
    }

    .login-header--text {
        color: #fff !important;
        font-size: 48px;
        text-transform: uppercase;
        letter-spacing: 10px;
        font-family: fantasy;
        letter-spacing: 15px;
    }

    .login-header {
        height: 100px;
    }

    .login-header-text-pro {
        color: #18f988 !important;
        font-size: 48px;
        text-transform: uppercase;
        letter-spacing: 15px;
        font-family: fantasy;
        margin-left: 10px;
    }

    .forms-box {
        height: 700px;
        background: #1b1b1b !important;
    }

    .box-form-title {
        font-size: 24px;
        line-height: 1;
        text-align: center;
        text-transform: uppercase;
        color: #ffffff;
        letter-spacing: 3px;
        font-weight: bold;
    }

    .wrap-input100 {
        width: 100%;
        position: relative;
    }

    .input100 {
        color: #fff;
        line-height: 1.2;
        font-size: 16px;
        display: block;
        width: 100%;
        height: 42px;
        outline: none;
        background: transparent;
        box-shadow: none;
        border-left: none;
        border-right: none;
        border-top: none;
        border-bottom: 2px solid #555;
    }

    .input100:focus {
        border-color: #18F988 !important;
        box-shadow: 0 1px 0 0 #18F988 !important;
        transition: .1s ease-in-out;
    }

    /*.focus-input100 {*/
    /*    position: absolute;*/
    /*    display: block;*/
    /*    width: 100%;*/
    /*    height: calc(100% + 2px);*/
    /*    top: -1px;*/
    /*    left: -1px;*/
    /*    pointer-events: none;*/
    /*    border: 3px solid #18f988;*/
    /*    border-radius: 10px;*/
    /*    box-shadow: none !important;*/


    /*    visibility: hidden;*/
    /*    opacity: 0;*/
    /*    transition: all 0.4s;*/
    /*    transform: scaleX(1.1) scaleY(1.3);*/
    /*}*/

    /*.input100:focus + .focus-input100 {*/
    /*    visibility: visible;*/
    /*    opacity: 1;*/
    /*    width: 100%;*/
    /*    transform: scale(1);*/
    /*}*/

    .form-check-label {
        color: #FFffff;
    }

    .button-box-login {
        z-index: 10;
    }

    .login-btn {
        width: 100%;
        height: inherit;
        font-size: 20px;
        line-height: 1;
        text-transform: uppercase;
        border:none !important;
        color: #ffffff;
        letter-spacing: 3px;
        padding: 20px 35px 20px;
        font-weight: bold;
        margin-bottom: 15px;
        background: #3cd978;
        border-radius: 2px;
        transition: .1s ease-in;
    }
    .login-btn:hover{
        box-shadow: 0px 0px 40px -9px rgba(24,249,136,1);
        transition: .2s ease-in;
    }
    .login-btn-sign{
        width: 100%;
        height: inherit;
        font-weight: bold;
        font-size: 20px;
        line-height: 1;
        text-transform: uppercase;
        border:none !important;
        color: #ffffff;
        letter-spacing: 3px;
        padding: 20px 35px 20px;
        margin-bottom: 15px;
        background-color:#1b1b1b;
        transition: .1s ease-in;
        box-shadow: 0 2px 5px #000;
        border-radius: 2px;
    }
    .login-btn-sign:hover {
        background: #3cd978;
        transition: .2s ease-in;
    }
    .forgotbox_link {
        font-weight: bold;
    }
</style>

<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php

$this->beginBody();

//require Root . '/webhtm/block/navbar/mainArbit.php';;


?>
<div id="page">
  <section class="login-back">
    <div class="container-fluid">
      <div class="row pt-4">
        <div class="col-md-12 login-header text-center">
          <a class="login-header--text">Arbit<span class="login-header-text-pro">Pro</span></a>
        </div>
      </div>

    </div>
    <div class="row">
      <div class="col-md-12 ">

        <div class="col-md-4 forms-box ml-auto mr-auto" style="min-width: 365px;">
          <div class="d-flex flex-column px-4">
            <div class="box-form-title pb-4 pt-5">SIGN IN</div>
            <div class="d-flex justify-content-center flex-wrap">
              <div class="wrap-input100 w-100 mb-5 mt-2 validate-input" data-validate="Username is required">
                <input class="input100"  type="email" name="email" placeholder="E-mail">
              </div>
              <br>
              <div class="wrap-input100 w-100 mb-4 validate-input" data-validate="Username is required">
                <input class="input100" type="password" name="pass" placeholder="Password">
              </div>
              <div class="form-check w-100 mt-4 p-0">
                <input class="form-check-input success-color" type="checkbox" id="gridCheck1">
                <label class="form-check-label" for="gridCheck1">
                  Example checkbox
                </label>
              </div>

              <div class="form-recaptcha w-100 mt-3">
                <div class="recaptcha">
                    <?php
                    echo ZRecaptchaWidget::widget([
                        'config' => [
                            'type' => ZRecaptchaWidget::type['v2-checkbox'],
                            'sitekey' => '6Lc26t8UAAAAAFofGeFQJhMmHQR3OexuG3vgP5Ph',
                        ]

                    ]);
                    ?>
                </div>
              </div>
              <br>
              <br>
              <!--form buttons-->
              <div class="button-box-login w-100 mt-0 mb-3">
                <button id="login" class="login-btn m-0" type="submit">LOGIN</button>
              </div>
              <div class="button-box-Sign w-100">
                <button class="login-btn-sign" type="submit">SIGN UP</button>
              </div>

              <div class="forgot_box ml-auto mr-auto text-center">
                <div class="forgotbox_title text-secondary">Forgot your password ?</div>
                <a class="forgotbox_link text-secondary" href="#">Restore</a>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>
  </section>
</div>
<script>
    /*var loginBtn = $("#login");
    loginBtn.attr('disabled', true);
    if(grecaptcha.getResponse().length == 0){
        alert('Please click the reCAPTCHA checkbox');
    }else{
        loginBtn.removeattr('disabled')
    }*/
    //var checkbox = $('#recaptcha-anchor');
    //var checkbox = $('[aria-checked]');
    /*var checkbox = $('#recaptcha-anchor').attr('aria-checked');
    //const checked = $("span[aria-checked = 'true']");
    //var checked = checkbox.hasAttribute("span[aria-checked = 'true']");
    console.log(checkbox);
    console.log("checkbox");
    console.log(checkbox);*/



</script>
<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>






