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
$action->csrf = false;
$action->debug = false;



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
<body class="<?= ZWidget::skin['white-skin'] ?> login-back">

<?php

$this->beginBody();

//require(Root . '/render/menus/ZSidebarWidget/ready/main.php');

?>
<div id="content" class="pb-5 d-flex justify-content-center align-items-center">

    <div class="col-md-12 p-5 text-center text-white">
        <h2 class="m-5">
            <?php

            echo Az::l('Мы отправили сообщение на вашу электронную почту. Пожалуйста, проверьте свою электронную почту.');

            ?>
        </h2>
        <h2 class="mr-4"><?php echo Az::l('Смс не пришел?') ?><a class="btn btn-info ml-5" id="resendEmail"><?php echo Az::l('Отправить заново') ?></a></h2>
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

<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>


<style>
    .login-back {
        background: url('/render/asrorz/arbit/img/first_bg1.png') fixed;
        background-size: cover;
        min-height: 700px;
    }
</style>




