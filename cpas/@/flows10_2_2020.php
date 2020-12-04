<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\cpas\CpasOffer;
use zetsoft\models\cpas\CpasLand;
use zetsoft\models\cpas\CpasStream;
use zetsoft\models\cpas\CpasStreamItem;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;use zetsoft\widgets\former\ZListViewWidget;
use zetsoft\widgets\inputes\ZSelect2Widget;
use zetsoft\widgets\navigat\ZBreadcrumbsWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;use zetsoft\widgets\themes\ZCardWidget;


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

</head>


<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php

$this->beginBody();

echo $this->require( '\webhtm\cpas\blocks\header.php');



?>

<div id="page">

    <?

    echo ZSessionGrowlWidget::widget();$id = $this->httpGet('id');
    ?>
    <div class="container-fluid  grey lighten-5">
        <div class="mt-2">
            <h2 class="text-muted">Потоки</h2>
            <div>
                <a href="/cpas/admin/index.aspx" style="font-size: small">Главная</a>
                <span style="font-size: small">/ Потоки</span>
            </div>
        <div class="row">
            <div class="col-md-12">
                <?php
                $needStreams = CpasStream::find()
                    ->orderBy('id desc')
                    ->all();
                 //vdd($needStreams);
                foreach ($needStreams as $key => $stream){

                    echo $this->require( '/webhtm/cpas/admin/flow.php', [
                        'id' => $stream->id
                    ]);
                    ?>

                    <?php
                }
                ?>
            </div>
        </div>
    </div>


</div>

</div>

<? echo $this->require( '\webhtm\cpas\blocks\footer.php'); ?>

<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
