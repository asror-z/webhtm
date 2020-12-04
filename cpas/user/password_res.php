<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\data\TabItem;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\market\ZFooterAllWidgetOrg;
use zetsoft\widgets\themes\ZTabWidget;
use zetsoft\widgets\themes\ZTabWidget2;


/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Восстановление пароля';
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

//require Root . '/webhtm/block/navbar/mainArbit.php';;


?>
<div id="page">
    <section class="login-back">
    <div class="container-fluid">
        <div class="row pt-5 px-5">
            <div class="col-md-6 col-10 p-2 mb-3">

                <?

                $pass = $this->require( '/webhtm/cpas/user/blocks/password_restore.php');


                $items = [
                    Az::l('Восстановление пароля') => $pass,
                ];

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
                        'mdTabColor' => ZTabWidget::mdTabColor['black'],
                        'classicTabColor' => ZTabWidget::classicTabColor['tabs-grey'],

                    ],
                ]);
                ?>
            </div>
            <div class="col-md-6">
                <img class="img-fluid" src="/render/asrorz/arbit/img/first_illustration1.png">
            </div>
        </div>
    </div>
</section>
</div>



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




