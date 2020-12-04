<?php

//use zetsoft\former\auth\CompanyRegisterForm;
use zetsoft\dbitem\core\WebItem;
use zetsoft\former\auth\AuthCompanyRegisterForm;
use zetsoft\former\auth\AuthRegisterCompanyForm;
use zetsoft\former\auth\AuthRegisterForm;
use zetsoft\models\user\User;
use zetsoft\models\user\UserCompany;
use zetsoft\service\forms\Active;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZHTML;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\iconers\ZAuthIconWidget;
use zetsoft\widgets\market\ZSVGWidget;


global $boot;
/** @var ZView $this */
$oathData = $this->sessionGet('oauthData');

$action = new WebItem();

$action->title = Azl . 'History';
$action->icon = 'fa fa-area-chart';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;

$action->cache = false;

$action->call = [
//    TagDependency::invalidate()
];
$action->cacheHttp = false;

$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

/** @var ZView $this */
$registerFormCompany = new AuthRegisterCompanyForm();
$registerFormCompany->configs->nameOn = [
    'login',
    'password',
    'role'

];
/** @var User $user */

if ($this->formModel($registerFormCompany) === true) {
    $registerFormCompany->role = 'seller';

    if (Az::$app->cores->auth->register($registerFormCompany)) {
        $company = new UserCompany();
        $company->save();

        $model = User::findOne($this->sessionGet('registerUser'));
        $model->user_company_id = $company->id;
        $model->save();

        if (Az::$app->cores->auth->isPhone($registerForm->login) && $boot->env('verifyPhone')) {
            return $this->urlRedirect('/core/user/user-auth/verify/verify-phone.aspx');
        }
        if ($returnUrl = $this->httpGet('returnUrl')) {
            $this->urlRedirect($returnUrl,false);
        }
        if ($boot->env('verifyEmail') && Az::$app->cores->auth->isEmail($registerForm->login)) {
            return $this->urlRedirect('/core/user/user-auth/verify/need-verify-email.php');
        } else {
            $this->urlRedirect("/shop/seller/settings/index.aspx?id=$company->id");
        }
    }

}
?>

<div class="d-flex justify-content-center align-items-center">
    <div class="col-md-10">

        <?php
        $active = new Active();
        $active->formAction='#tab-3';
         $formCompany = $this->activeBegin($active); ?>
        <div class="text-center d-flex justify-content-center">
            <h1 class="text-success mt-3 mb-5">
                <?php
                    echo ZSVGWidget::widget()
                ?>
            </h1>
        </div>
        <?
        echo ZFormWidget::widget([
            'model' => $registerFormCompany,
            'form' => $formCompany,
            'config' => [
                'topBtn' => false,
                'botBtn' => false,
            ],
        ]);
        ?>
        <div class="d-flex justify-content-center">
            <div class="col-md-7 mb-5">
                <?php
                echo ZHTML::submitButton(Az::l('<h6 class="m-0">РЕГИСТРАЦИЯ</h6>'), ['class' => 'w-100 btn btn-success']);
                ?>

            </div>
        </div>
        <div class="flex-column align-items-center justify-content-center">
            <div class="justify-content-center">
                <?
                if (!$oathData) {
                    ?>
                    <h3 class="text-center text-success mb-3"> Быстрый доступ с </h3>

                    <?
                    echo ZAuthIconWidget::widget([
                    ]);
                } ?>
            </div>
        </div>
        <?php $this->activeEnd(); ?>

    </div>

</div>
