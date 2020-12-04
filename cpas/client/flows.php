<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\cpas\CpasStream;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZListViewWidget;

/** @var ZView $this */


/**
 *
 * Action Params
 * @author Jakhongir Kudratov
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


<body class="hold-transition sidebar-mini">

<?php

$this->beginBody();

echo $this->require( '\webhtm\cpas\blocks\header.php');
?>
    <div class="container-fluid">
        <div class="mt-2">
            <h2 class="text-muted">Потоки</h2>
            <div>
                

                <a href="/cpas/client/statistic.aspx" style="font-size: small"><?= Az::l('Главная')?></a>
                <span style="font-size: small">/ <?= Az::l('Потоки')?></span>
                    
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?php

                    $needStreams = Az::$app->cpas->cpa->getStreamsByUser();
                    $user_id = $this->userIdentity()->id;
                    $model = new CpasStream();
                    $model->configs->query = CpasStream::find()->where(['user_id' => $user_id])
                        ->orderBy([
                            'id' => SORT_DESC
                        ]);
                    if (!$needStreams){
                        ?>
                        <div class="col-md-3 ml-auto text-right">
                            <a href="/cpas/client/offer.aspx" class="add-flow">
                                Добавить Поток
                            </a>
                        </div>

                           <h1 class="text-center">
                              <?= Az::l('У вас нет потоков.')?>
                           </h1>

                        <div class="col-md-12 text-center">

                           <i class="fal fa-sitemap" style="font-size: 300px; margin-top: 40px;"></i>

                        </div>

                        <?php
                    }

                    echo ZListViewWidget::widget([
                        'model' => $model,
                        'config' => [
                            'type' => ZListViewWidget::type['model'],
                            'itemView' => function ($model, $key, $index, $widget) {
                                return $this->require('/webhtm/cpas/client/flow.php', [
                                    'id' => ZArrayHelper::getValue($model, 'id')
                                ]);
                            },
                            'layout' => "{items}\n{pager}",
                        ]
                    ]);
                        ?>


                </div>
            </div>
        </div>
    </div>
<? echo $this->require( '\webhtm\cpas\blocks\footer.php'); ?>

<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
