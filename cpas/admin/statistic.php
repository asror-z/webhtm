<?php

use kartik\grid\DataColumn;
use zetsoft\dbitem\core\WebItem;
use zetsoft\former\cpas\CpasTrackForm;
use zetsoft\models\cpas\CpasStreamStats;
use zetsoft\system\Az;
use zetsoft\system\column\ZKDataColumn;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZDynaWidgetJahongir;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;



/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Cтатистика';
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

echo $this->require( '\webhtm\cpas\blocks\header.php');


?>

<div id="page">

    <?

    echo ZSessionGrowlWidget::widget();?>

    <div id="content" class="content-footer p-3">

        <div class="row">
          <a href="users.aspx" class="btn btn-primary">Баланс клиентов</a>
            <?php
                
                //start|JakhongirKudratov

                $users = collect(\zetsoft\models\user\User::find()->where(['role' => 'client'])->all());
                $model = new CpasTrackForm();
                $model->configs->nameOn = [
                    'user',
                    'click',
                    'unique_click',
                    'cr',
                    'EPC',
                    'approve',
                    'Valid',
                    'confirmed',
                    'await',
                    'canceled',
                    'all',
                    'trash',
                    'earned_money',
                ];
                $model->configs->before = [
                    'user' =>[
                        [
                            'class' => ZKDataColumn::class,
                            'label' => Az::l('Посмотреть Лендинг'),
                            'width' => '100px',
                            'value' => function ($model, $key, $index, DataColumn $dataColumn) use ($users) {
                                $user_email = $model->user;
                                $user = $users->where(
                                    'email', $user_email
                                )->first();
                                $url = '/cpas/admin/clientStatistic.aspx?id='.$user->id;
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
                $data = Az::$app->cpas->cpasStats->generateAdminStats($users);
                echo ZDynaWidget::widget([
                'data' => $data,
                'model' => $model,
                'type' => ZDynaWidget::type['form'],
                'rightBtn' => [
                    'system' => [
                        'content' => '',
                        'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                    ],

                    'toggleData' => [
                        'content' => '',
                        'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
                    ],

                    'statistics' => [
                        'content' => '',
                        'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                    ],

                    'add-clone-delete' => [
                        'content' => '',
                        'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                    ],

                    'export' => [
                        'content' => '{export}',
                        'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
                    ],
                    'filter-sort-id' => [
                        'content' => '',
                        'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                    ],
                ],
                'config' => [
                        'title'=>Az::l('Статистика пользователей'),
                        'type' => 'form',
                        'hasToolbar' => true,
                        'editableLink' => true,
                        'search' => false,
                        'copy' => false,
                        'columnBefore' => [
                            'false'
                        ],
                        'isCard' => false,
                        'columnAfter' => ['asd'],
                        'theme' => 'success',
                        'bordered' => false,
                        'striped' => true,

                    ]
            ]);

                //end|JakhongirKudratov

            ?>
        </div>


    </div>

</div>



<? echo $this->require( '\webhtm\cpas\blocks\footer.php'); ?>

<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
