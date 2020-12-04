<?php


use zetsoft\dbitem\core\WebItem;
use zetsoft\models\dyna\DynaStats;
use zetsoft\system\actives\ZActiveRecord;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\former\ZCheckRedirectWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;

$action = new WebItem();

$action->title = Azl . 'Страны';
$action->icon = 'fal fa-landmark';
$action->type = WebItem::type['html'];
$action->csrf = true;
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
    require Root . '/webhtm/block/assets/main.php';


    /** @var ZView $this */
    //$this->fileCss('/block/assets/ALL/all.css');

    $this->head();

    ?>

    <title></title>
</head>

<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php

$this->beginBody();

?>

<div id="page">

    <?

    echo ZSessionGrowlWidget::widget();?>

    <div id="content" class="content-footer p-3">

        <div id="page">

            <?php
            /** @var ZActiveRecord $model */
            /** @var ZView $this */

            $modelClassName = $this->httpGet('modelName');
            $dynaId = $this->httpGet('dynaId');
            $modelClass = $this->bootFull($modelClassName);
            $url = $this->httpGet('url');
            $model = new DynaStats();
            $data = $this->urlParam;

            $view = ZCheckRedirectWidget::widget([
                'model' => $model,

                'config' => [
                    'url' => ZUrl::to([
                        '/core/dynagrid/stat_view',
                        'dynaId' => $dynaId,
                        'modelName' => $modelClassName,
                        'url' => $url,
                    ]),
                    'confirm' => false,
                    'icon' => 'fas fa-table'
                ]
            ]);


            $chart = ZCheckRedirectWidget::widget([
                'model' => $model,

                'config' => [
                    'url' => ZUrl::to([
                        '/core/dynagrid/stat_chart',
                        'dynaId' => $dynaId,
                        'modelName' => $modelClassName,
                        'url' => $url,
                    ]),
                    'confirm' => false,
                    'icon' => 'fas fa-chart-line'
                ]
            ]);

            $home = ZButtonWidget::widget([
                'model' => $model,

                'config' => [
                    'url' => ZUrl::to([
                        "/$url",
                    ]),
                    'icon' => 'fas fa-home',
                    'btnRounded' => false
                ]
            ]);

            $model->configs->query = DynaStats::find()
                ->where([
                    'models' => $modelClassName,
                    'dynaId' => $dynaId
                ]);


            $model->configs->filter = false;

            $model->columns();

            echo ZDynaWidget::widget([
                'model' => $model,
                'rightName' => [
                    'update',
                    'add-clone-delete',
                    'view-res',
                    'home'
                ],
                'rightBtn' => [
                    'update' => [
                        'content' => '{update}',
                        'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                    ],

                    'add-clone-delete' => [
                        'content' => '{add}{clone}{delete}',
                        'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                    ],
                    'view-res' => [
                        'content' => $view . $chart,
                        'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                    ],
                    'home' => [
                        'content' => $home,
                        'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                    ]
                ],
                'config' => [
                    'isNewRecord' => true,
                    'search' => false,
                    'columnBefore' => [
                        'radio',
                        'serial',
                        'action',
                    ],
                    'actionButtons' => [
                        'clone',
                        'delete',
                    ],
                    'columnAfter' => false,
                    'newRecordValues' => [
                        'models' => $this->httpGet('modelName'),
                        'dynaId' => $dynaId,
                    ],
                ],
            ]);

            ?>
        </div>

    </div>

    <?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
