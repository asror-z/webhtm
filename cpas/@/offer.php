<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\cpas\CpasOffer;
use zetsoft\models\cpas\CpasOfferItem;
use zetsoft\models\cpas\CpasLand;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZListViewWidget;
use zetsoft\widgets\inputes\ZSelect2Widget;
use zetsoft\widgets\navigat\ZBreadcrumbsWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
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
$action->csrf = false;
$action->debug = false;



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

    echo ZSessionGrowlWidget::widget();$this->userIdentity()->user_company_id;

    ?>
    <div class="container-fluid  grey lighten-5">
        <div class="mt-2">
            <h2 class="text-muted">Офферы</h2>
            <?php
            $id = $this->httpGet('id');
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
                $urlcreate = ZUrl::to([
                    '/cpas/main/createOffer',
                    'id' => $id,
                ]);
                echo ZButtonWidget::widget([
                    'config' => [
                        'url' => $urlcreate,
                        'text' => Az::l('Создать'),
                        'btnStyle' => ZButtonWidget::btnStyle['btn-success'],
                        'hasIcon' => false,
                        'btn' => true,
                        'class' => 'py-2 px-3',
                        'btnRounded' => false,
                    ]
                ]);

                $model = new CpasOffer();
                $model->query = CpasOffer::find()
                    ->where([
                        '!=', 'status', 'not_accepted'
                    ]);
                echo ZListViewWidget::widget([
                    'model' => $model,
                    'config' => [
                        'type' => ZListViewWidget::type['model'],
                        'itemView' => function ($model, $key, $index, $widget){
                            return $this->require( '/webhtm/cpas/block/card.php', [
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
