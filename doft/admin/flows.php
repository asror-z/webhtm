<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\cpas\CpasOffer;
use zetsoft\models\cpas\CpasLand;
use zetsoft\models\cpas\CpasStream;
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
    require Root . '/webhtm/block/assets/main.php';

    $this->head();

    ?>

</head>


<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php

$this->beginBody();

require Root . '/webhtm/block/navbar/mainArbit.php';;


echo ZNProgressWidget::widget([]);

echo ZNProgressWidget::widget([]);


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
                $model = new CpasStream();

                echo ZListViewWidget::widget([
                    'model' => $model,
                    'config' => [
                        'type' => ZListViewWidget::type['model'],
                        'itemView' => function ($model, $key, $index, $widget){
                            return $this->require( '/webhtm/cpas/admin/flow.php', [
                                'id' => $model->id
                            ]);
                        },
                        'layout' => "{items}\n{pager}"
                    ]
                ]);
                ?>
            </div>
        </div>
    </div>


</div>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
