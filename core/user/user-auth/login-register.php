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
require(Root . '/webhtm/block/header/mainM.php');
require(Root . '/webhtm/block/navbar/main.php');

?>

<section class="login-back">
    <div class="container-fluid">
        <div class="row pt-5">
            <div class="col-lg-6 col-10 ml-md-5 p-2 mb-3">

                <?
                global $boot;
                $login = $this->require( '/webhtm/core/user/user-auth/blocks/login.php');
                $register = $this->require( '/webhtm/core/user/user-auth/blocks/register.php');
                $registerCompany = $this->require( '/webhtm/core/user/user-auth/blocks/register-company.php');

                $items = [
                    Az::l('Вход') => $login,
                    Az::l('Регистрация покупателя') => $register,
                ];

                if ($boot->env('companyRegister')) {
                    $items[Az::l('Регистрация компании')] = $registerCompany;
                }

                $content = [];
                foreach ($items as $key => $value) {
                    $tabItem = new TabItem();
                    $tabItem->title = $key;
                    $tabItem->content = $value;
                    $content[] = $tabItem;
                }

                echo ZTabWidget::widget([
                    'data' => $content,
                    'config' => [
                        'type' => ZTabWidget::type['classic'],
                        'mdTabColor' => ZTabWidget::mdTabColor['white'],
                        'classicTabColor' => ZTabWidget::classicTabColor['tabs-grey'],

                    ],
                ]);
                ?>
            </div>
        </div>
    </div>
</section>


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




