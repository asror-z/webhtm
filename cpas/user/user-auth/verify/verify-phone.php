<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\core\CoreAdvancedItem;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;


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
<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php

$this->beginBody();
//require(Root . '/webhtm/block/header/main.php');
//require(Root . '/webhtm/block/navbar/main.php');
//require(Root . '/render/menus/ZSidebarWidget/ready/main.php');
//require Root . '/webhtm/block/navbar/mainArbit.php';;
?>
 <div id="content" class="pb-5" style="height: 100vh;
 background: url('/render/cpa/images/first_bg1.png'); background-size: 100% 100%;">

     <!--https://cdn.hipwallpaper.com/i/48/53/VesNSJ.jpg-->

     <div class="row p-5">

     <div class="col-md-6 pt-5">

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
         <div class="col-md-6">
             <img class="img-fluid" src="/render/cpa/images/first_illustration1.png">
         </div>



     </div>
 </div>


<script>
    
    $('.verify').on('keyup', function () {
        let thisVal = $(this);
        if ($(this).val().length > 4){
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

              if(data){
                verifyInput.val("");
                document.location.href = '/cpas/admin/statistic.aspx';
              }
              
              if(data === false) {
                let dangerAlert = "<div class=\"alert alert-danger\">\n" +
                    "Ваш код неверный" +
                    "</div>";
                $('.dangerAlert').append(dangerAlert);

                verifyInput.val("");

                setTimeout(function () {
                    $('.dangerAlert').empty();
                }, 3000);

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
              }, 10000);
              
          }
       });
    });

</script>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>





