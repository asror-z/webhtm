<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\blocks\ZNProgressWidget;


/** @var ZView $this */


/**
 *
 * Action Params
 * @author Shahzod Gulomqodirov
 */

$action = new WebItem();

$action->title = Azl . 'Потоки';
$action->icon = 'fa fa-globe';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;



$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();


/**
 *
 * Start Page
 */

$this->beginPage();
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>

    <?php

    require Root . '/webhtm/block/metas/main.php';
    require Root . '/webhtm/block/assets/App/main_arbit.php';

    $this->head();

    ?>
    <link rel="stylesheet" href="/render/asrorz/fontawesome-pro-5.12.0-web/css/all.css">

    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="/render/asrorz/css-app/arbitTemplate/adminlte.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini">
<?php

$this->beginBody();



echo $this->require( '\webhtm\cpas\blocks\header.php')
?>


<?

$id = $this->httpGet('id');
?>

<div class="container-fluid">
    <div class="mt-2">
        <h2 class="text-muted">Потоки</h2>
        <div>

            <a href="/cpas/client/statistic.aspx" style="font-size: small">Главная</a>
            <span style="font-size: small">/ Потоки</span>

        </div>
        <div class="row">
            <div class="col-md-12">
                <?php
                $needStreams = Az::$app->cpas->cpa->getStreamsByUser();

                foreach ($needStreams as $key => $stream) {
                    echo $this->require( '/webhtm/cpas/client/flowAbl.php', [
                        'id' => $stream->id
                    ]);
                }
                ?>

            </div>
        </div>
    </div>
</div>

<?php
echo $this->require( '\webhtm\cpas\blocks\footer.php');
$this->endBody() ?>


</body>
</html>

<?php $this->endPage() ?>
<?php
