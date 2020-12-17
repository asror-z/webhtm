<?php

use kartik\grid\DataColumn;
use zetsoft\dbitem\core\WebItem;
use zetsoft\former\cpas\CpasUserFlowsForm;
use zetsoft\former\cpas\CpasTrackForm;
use zetsoft\models\cpas\CpasStream;
use zetsoft\models\cpas\CpasStreamStats;
use zetsoft\models\cpas\CpasTracker;
use zetsoft\system\Az;
use zetsoft\system\column\ZKDataColumn;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Потоки';
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

echo $this->require('\webhtm\cpas\blocks\header.php');


?>

<div id="page">

    <?

    echo ZSessionGrowlWidget::widget();?>

    <div id="content" class="content-footer p-3">

        <div class="row">
            <div class="mt-2 bg-white d-block py-3 px-1 w-100">
                <h2 class="text-muted"><?= Az::l('Потоки') ?></h2>
                <div>
                    <a href="/cpas/admin/statistic.aspx" style="font-size: small"><?= Az::l('Главная') ?></a>
                    <span style="font-size: small">/ <?= Az::l('Потоки') ?></span>
                </div>
            </div>
            <div class="mt-5 col-12 col-md-12">

                <?php

                $users = collect(\zetsoft\models\user\User::find()->all());
                $data = Az::$app->cpas->cpa->generateFlowsByUser();

                $model = new CpasUserFlowsForm();
                $model->configs->before = [
                    'user' =>[
                        [
                            'class' => ZKDataColumn::class,
                            'label' => Az::l('Посмотреть Лендинг'),
                            'width' => '100px',
                            'value' => function ($model, $key, $index, DataColumn $dataColumn) use ($users) {
                                $user = $users->where('email', $model->user)->first();
                                if (empty($user))
                                    return null;

                                $url = '/cpas/admin/userFlows.aspx?id='.$user->id;
                                return ZButtonWidget::widget([
                                    'config' => [
                                        'text' => '',
                                        'url' => $url,
                                        'btnSize' => ZButtonWidget::btnSize['btn-lg'],
                                        'class' => "ZDynaBTN p-0",
                                        'title' => Az::l('Просмотр'),
                                        'btnRounded' => false,
                                        'btn' => false,
                                        'hasIcon' => '',
                                        'imgWidth' => '42px',
                                        'imgHeight' => '42px',
                                        'src' => '/render/former/ZDynaWidget/assets/img/view.svg',
                                        'img' => true,
                                        //'icon' => 'fas fa-eye',
                                        'target' => ZButtonWidget::target['_blank'],
                                    ],
                                ]);


                            }
                        ],

                    ]
                ];
                $model->columns();

                echo ZDynaWidget::widget([
                    'model' => $model,
                    'type' => ZDynaWidget::type['form'],
                    'data' => $data,

                    'config' => [
                        'showFooter' => false,
                        'titleSummary' => true,
                        'isCard' => false,
                        'columnBefore' => [
                            'false',
                            //'relation'
                        ],


                        'viewUrl' => '{fullUrl}/viewflowdyna.aspx?id={id}',
                        'columnAfter' => false,
                        'hasToolbar' => false,
                        'search' => false,
                        'heighbody' => '100%',
                        'summary' => true,
                        'perfectScrollbar' => true,
                        'striped' => false,
                        'hasWidth' => false,
                        //'panelTemplate' => "{items}",
                        'hasItems' => false,
                        'relations' => false,
                        'relationMulti' => false

                    ]
                ])

                ?>

            </div>

        </div>


    </div>

</div>


<? echo $this->require('\webhtm\cpas\blocks\footer.php'); ?>

<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
