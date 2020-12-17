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
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\themes\ZCardWidget;


/** @var ZView $this */


/**
 *
 * Action Params
 * @author Shahzod Gulomqodirov
 */

$action = new WebItem();

$action->title = Azl . 'Офферы';
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


<body class="hold-transition sidebar-mini">

<?php

$this->beginBody();



echo $this->require( '\webhtm\cpas\blocks\header.php');
?>
    <?
    $this->userIdentity()->user_company_id;

    ?>
<div class="panel-body">
    <div class="m-b-md">
        <h5>
            Создать поток                        </h5>
    </div>

</div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php
                //                $urlcreate = ZUrl::to([
                //                    '/cpas/main/createOffer',
                //                    'id' => $id,
                //                ]);
                //                echo ZButtonWidget::widget([
                //                    'config' => [
                //                        'url' => $urlcreate,
                //                        'text' => Az::l('Создать'),
                //                        'btnStyle' => ZButtonWidget::btnStyle['btn-success'],
                //                        'hasIcon' => false,
                //                        'btn' => true,
                //                        'class' => 'py-2 px-3',
                //                        'btnRounded' => false,
                //                    ]
                //                ]);

                $model = new CpasOffer();

                /*$model->query = CpasOffer::find()
                    ->where([
                        '!=', 'status', 'not_accepted'
                    ]);*/

                echo ZListViewWidget::widget([
                    'model' => $model,
                    'config' => [
                        'type' => ZListViewWidget::type['model'],
                        'itemView' => function ($model, $key, $index, $widget) {
                            return $this->require(Root . '/webhtm/cpas/client/card.php', [
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


<script>
    var account = Analytics.Management.Accounts.list().items[0];
    console.log(account);
    /*var webProperties = Analytics.Management.Webproperties.list(account.id);
    ...
    var report = Analytics.Data.Ga.get(tableId, startDate, endDate, metric,
        options);*/
</script>

<? echo $this->require(Root . '\webhtm\cpas\blocks\footer.php'); ?>
<?php $this->endBody() ?>

</body>

</html>

<?php $this->endPage() ?>
