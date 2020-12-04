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

echo $this->require('/webhtm/block/navbar/adminNewLogin.php');


echo $this->sessionCookie();
echo $this->sessionDel('login');
//echo Az::$app->cores->auth->setLogin(79);

?>
<!--start:TursunaliyevAbdulloh-->




<!--end:TursunaliyevAbdulloh-->
<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>






