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

    $this->fileCss('/render/asrorz/css/logins.css');

    ?>

    <link href="//fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,700,700i" rel="stylesheet">

    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

</head>
<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php

$this->beginBody();
require(Root . '/webhtm/block/header/main.php');
require(Root . '/webhtm/block/navbar/main.php');

?>
<!--start:TursunaliyevAbdulloh-->

    <div class="container-fluid">

            <div class="main-w3layouts wrapper">
                <h1>Вход</h1>
                <div class="main-agileinfo">
                    <div class="agileits-top">
                       <?php

                         echo   $this->require('/webhtm/core/user/user-auth/blocks/login.php');

                       ?>
                    </div>
                </div>
                <ul class="colorlib-bubbles">
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                </ul>
            </div>
      
    </div>



<!--end:TursunaliyevAbdulloh-->
<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>






