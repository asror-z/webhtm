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
 */

$action = new WebItem();

$action->title = Azl . 'Создание Бренды';
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
            <?php

            if (isset($id))
                echo ZBreadcrumbsWidget::widget([
                    'config' => [
                        'mode' => ZBreadcrumbsWidget::mode['page'],
                        'category_id' => $id
                    ]
                ]);
            ?>
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
                            return $this->require( '/webhtm/cpas/block/flow.php', [
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

    <!--    --><?//= $this->require( '/webhtm/block/footer/cpas/footerAdmin.php') ?>
</div>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
