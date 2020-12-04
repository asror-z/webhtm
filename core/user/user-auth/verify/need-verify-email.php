<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\data\TabItem;
use zetsoft\models\core\CoreAdvancedItem;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;

use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\cards\ZAzCardWidget;
use zetsoft\widgets\market\ZFooterAllWidget;
use zetsoft\widgets\market\ZFooterAllWidgetOrg;
use zetsoft\widgets\market\ZMenuWidgetAbdulloh;
use zetsoft\widgets\market\ZMSwiperDbWidget;
use zetsoft\widgets\market\ZMSwiperWidget;
use zetsoft\widgets\menus\ZSidebarWidget;
use zetsoft\widgets\navigat\ZSmartTabWidget;
use zetsoft\widgets\navigat\ZjQuerySmartTabWidget2;
use zetsoft\widgets\navigat\ZSmartTabWidget2;
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
if(!$this->sessionGet('registerUserEmail')){
   return $this->urlRedirect($this->bootEnv('urlHome'));
}
//vdd($email);

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
require(Root . '/webhtm/block/header/main.php');
require(Root . '/webhtm/block/navbar/main.php');
//require(Root . '/render/menus/ZSidebarWidget/ready/main.php');

?>
<div id="content" class="pb-5" style="height: 100vh;
 background: url('https://revistas.unne.edu.ar/public/site/background/backgroundSite02.jpg'); background-size: 100% 100%;">
    <div class="col-md-12 p-5 text-center">
        <p><?php echo Az::l('Смс не пришел?') ?><a id="resendEmail"><?php echo Az::l('Отправить заново') ?></a></p>
    </div>
</div>


<script>
    $('#resendEmail').on('click', function () {
        $.ajax({
            method: "POST",
            url: '/api/core/auth/resend-email.aspx',
            success: function (response) {

                $('.resendVerify').attr('disabled', 'disabled');
                setTimeout(function () {
                    $('.resendVerify').removeAttr("disabled");
                }, 50000);

            }
        });
    });

</script>

<?= ZFooterAllWidgetOrg::widget() ?>
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




