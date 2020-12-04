<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\market\ZFooterAllWidgetOrg;
use zetsoft\dbdata\auth\RoleData;
use zetsoft\dbdata\eyuf\RoleAppData;
use zetsoft\former\auth\AuthLoginForm;
use zetsoft\service\forms\Active;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZHTML;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\iconers\ZAuthIconWidget;
use zetsoft\widgets\market\ZSVGWidget;

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
    require(Root . '/webhtm/block/assets/main.php');

    $this->head();

    ?>

</head>
<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php

$this->beginBody();

?>

<?php


/** @var ZView $this */
$loginForm = new AuthLoginForm();

if ($this->formModel($loginForm) === true) {

    if ($return = Az::$app->cores->auth->login($loginForm)) {
        if ($return === 'NeedEmail') {
            return $this->urlRedirect($this->bootEnv('verifyMailUrl'));
        }
        if ($return === 'NeedPhone') {
            return $this->urlRedirect($this->bootEnv('verifyPhoneUrl'));
        }
        $arrayRoles = new RoleData();
        $roles = $arrayRoles->name();
        //vd($this->userIdentity()->role);
        //vdd($roles);
        $role = ZArrayHelper::getValue($roles, $this->userIdentity()->role);
        $lastUrl = "/$role/main/index.aspx";

        //if (!empty($this->httpGet('redirectUrl')))
        //$lastUrl = ZArrayHelper::getValue($this->httpGet(), 'redirectUrl');

        //vdd($roles[$this->userIdentity()->role]);
//                     vdd($this->userIdentity()->role);
        //vdd($this->userIdentity());
        if ($this->httpGet('returnUrl')) {
            return $this->urlRedirectReturn();
        }
        switch ($this->userIdentity()->role) {
            case 'admin':
                $this->urlRedirect('/shop/admin/main/main.aspx');
                break;

            case 'user':
                $this->urlRedirect('/shop/user/main/main.aspx');
                break;

            case 'seller':
                $this->urlRedirect('/shop/seller/main/index.aspx');
                break;

            case 'logistics':
                $this->urlRedirect('/shop/logistics/shop-order/index.aspx');
                break;

            case 'warehouse':
                $this->urlRedirect('/shop/warehouse/ware/index.aspx');
                break;

            case 'supervisor':
                $this->urlRedirect('/shop/supervisor/main/index.aspx');
                break;

            case 'agent':
                $this->urlRedirect('/shop/agent/manual/main.aspx');
                break;

            case 'client':
                $this->urlRedirect('/shop/user/main-common/main.aspx');
                break;

            case 'complect':
                $this->urlRedirect('/shop/complect/main/index.aspx');
                break;

            case 'courier':
                $this->urlRedirect('/shop/courier/main/main.aspx');
                break;

            case 'deliver':
                $this->urlRedirect('/shop/deliver/main/index.aspx');
                break;
        }
    }
}


?>

<div class="d-flex justify-content-center align-items-center mb-5">
    <div class="col-md-10">

        <?php $active = new Active();
        $active->type = Active::type['horizontal'];
        $form = $this->activeBegin($active);

        ?>

        <div class="text-center d-flex justify-content-center">
            <h1 class="text-success mt-3 mb-5">
                <?php
                echo ZSVGWidget::widget()
                ?>
            </h1>
        </div>

        <?php

        echo ZFormBuildWidget::widget([
            'model' => $loginForm,
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
                echo ZHTML::submitButton(Az::l('<h6 class="m-0">Вход в систему</h6>'), ['class' => 'w-100 btn btn-success']);
                ?>
            </div>
        </div>
        <div class="flex-column align-items-center justify-content-center mb-0">
            <div class="justify-content-center">
                <h3 class="text-center text-success"> Войти через </h3>
                <?


                echo ZAuthIconWidget::widget([

                ])
                ?>
            </div>
        </div>

        <?php $this->activeEnd(); ?>
    </div>
</div>





<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>


<style>
    .login-back {
        background: url('/render/asrorz/images/Regback.png') fixed;
        background-size: cover;
        min-height: 700px;
    }
</style>




