<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\data\TabItem;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\market\ZFooterAllWidgetOrg;
use zetsoft\widgets\themes\ZTabWidget;


/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Вход';
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

    $this->fileCss('/render/asrorz/css/loginCRM/main.css');

    ?>
    
</head>
<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php

$this->beginBody(); 


echo $this->require('/webhtm/block/navbar/adminNewD.php');
?>
<!--start:TursunaliyevAbdulloh-->

    
          <div class="container-fluid">

             <div class="row">


                <div class="col-md-8 mainLoginParent">

                    <div class="d-flex">

                        <div class="col-md-5 loginImg">

                            <h3 class="text-center loginHeader text-primary text-uppercase mt-5"> Войти</h3>

                            <img src="/render/asrorz/images/loginImg/authentication.png" alt="">


                            <a href="registerCRM.aspx" class="btn btn-outline-primary loginBtn btn2">Регистрация</a>
                            
                        </div>

                        <div class="col-md-7">
                            <?php


                        

                            echo   $this->require('/webhtm/core/user/user-auth/blocks/loginCrm.php');

                            ?>
                        </div>

                    </div>

                </div>


             </div>

          </div>


<!--end:TursunaliyevAbdulloh-->
<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>






