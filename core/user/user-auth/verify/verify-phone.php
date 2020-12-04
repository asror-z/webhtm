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

    <!--https://cdn.hipwallpaper.com/i/48/53/VesNSJ.jpg-->

    <div class="col-md-12 p-5">

        <div class="col-md-6 ml-auto mr-auto pt-5">

            <div class="card">
                <div class="card-header bg-white">
                    Подтверждение кода
                </div>
                <div class="card-body">
                    <div class="col-md-12 d-flex justify-content-center">
                        <div class="col-md-6 pt-5">
                            <input type="text" class="form-control verify">
                        </div>
                        <div class="col-md-4 pt-5">
                            <button class="btn btn-block verify-btn">Подтвердить</button>
                        </div>
                    </div>

                    <div class="col-md-12 d-flex justify-content-center pt-5 ml-3">
                        <div class="col-md-5 ml-5">
                            <p class="fp-25 text-dark">Не получили код?</p>
                        </div>
                        <div class="col-md-4 ml-4">
                            <button class="btn btn-block resendVerify">Получить код</button>
                        </div>

                        <div class="col-md-2">

                            <p class="timer"></p>

                        </div>

                    </div>

                    <div class="dangerAlert col-md-6 pt-5 ml-auto mr-auto">

                    </div>
                </div>
            </div>

        </div>


    </div>
</div>


<script>

    $('.verify').on('keyup', function () {
        let thisVal = $(this);
        if ($(this).val().length > 4) {
            thisVal.val("");

            let dangerAlert = "<div class=\"alert alert-danger\">\n" +
                "Введите только 4 число" +
                "</div>";
            $('.dangerAlert').append(dangerAlert);

            setTimeout(function () {
                $('.dangerAlert').empty();
            }, 3000);
        }
    });

    $('.verify-btn').on('click', function () {
        let verifyInput = $('.verify');

        let values = verifyInput.val();

        $.ajax({
            method: "POST",
            url: '/api/core/auth/verify-phone.aspx',
            data: {
                code: values,
            },
            success: function (data) {
                console.log(data);
                if (data === false) {
                    let dangerAlert = "<div class=\"alert alert-danger\">\n" +
                        "Ваш код неверный" +
                        "</div>";
                    $('.dangerAlert').append(dangerAlert);

                    verifyInput.val("");

                    setTimeout(function () {
                        $('.dangerAlert').empty();
                    }, 3000);

                }
                if (data === 'expired') {
                    let dangerAlert = "<div class=\"alert alert-danger\">\n" +
                        "Срок действия вашего кода истек" +
                        "</div>";
                    $('.dangerAlert').append(dangerAlert);

                    verifyInput.val("");

                    setTimeout(function () {
                        $('.dangerAlert').empty();
                    }, 3000);

                }
                
                if (data) {
                    verifyInput.val("");
                    document.location.href = '/shop/user/main-common/main.aspx';
                }
            }
        });

    });

    $('.resendVerify').on('click', function () {
        $.ajax({
            method: "POST",
            url: '/api/core/auth/resend-code.aspx',
            success: function (response) {

                $('.resendVerify').attr('disabled', 'disabled');
                setTimeout(function () {
                    $('.resendVerify').removeAttr("disabled");
                }, 30000);
            }
        });
    });

    $('.resendVerify').attr('disabled', 'disabled');
    setTimeout(function () {
        $('.resendVerify').removeAttr("disabled");
    }, 10000);
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




