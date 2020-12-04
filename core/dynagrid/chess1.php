<?php


use kartik\grid\GridView;

use kartik\grid\DataColumn;
use rmrevin\yii\fontawesome\FA;
use zetsoft\dbitem\core\WebItem;
use zetsoft\models\dyna\DynaChess1;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;

$action = new WebItem();

$action->title = Azl . 'Страны 1';
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

    <? echo ZSessionGrowlWidget::widget();?>

    <div id="content" class="content-footer p-3">

        <?php
        $models = $this->httpGet('modelClass');

        if (empty($models))
            throw new Exception('Необходимый параметр не найден');

        $query = $this->httpGet('query');

        $model = new DynaChess1();

        $role =  $this->userRole();

        $model->configs->after = [

            'active' => [

                [
                    'class' => 'zetsoft\\system\\column\\ZKDataColumn',

                    'label' => 'Редактировать',

                    'format' => 'raw',

                    'value' => function ($model, $key, $index, DataColumn $dataColumn) {

                        return ZButtonWidget::widget([

                            'id' => $key,

                            'config' => [
                                'title' => Az::l('Редактировать'),
                                'icon' => 'fas fa-edit',
                                'pjax' => 0,

                                'url' => '/core/dynagrid/chess_item1.aspx?id=' . $key . '&modelClass=' . $model['models'],

                                'btnRounded' => false,
                                'btn' => false,
                                'hasIcon' => true,
                            ],

                            'event' => [
                                'click' => 'function(event){event.preventDefault(); window.open(this.href, "_blank")}',
                            ],

                        ]);
                    },

                ],

                [
                    'class' => 'zetsoft\\system\\column\\ZKDataColumn',
                    'label' => 'Посмотреть',
                    'format' => 'raw',
                    'value' => function ($model, $key, $index, DataColumn $dataColumn)  {
                        //$items = DynaChessItem
                        return ZButtonWidget::widget([

                            'id' => $key,

                            'config' => [

                                'title' => Az::l('Посмотреть'),
                                'icon' => 'fas fa-' . FA::_EXTERNAL_LINK_ALT,
                                'pjax' => 0,
                                
                                'url' => ZUrl::to([
                                    '/core/dynagrid/chess_view1',
                                    'id' => $key,

                                    'modelClass' => $model['models'],
                                ]),

                                'btnRounded' => false,
                                'btn' => false,
                                'hasIcon' => true,

                            ],

                            'event' => [
                                'click' => 'function(event){event.preventDefault(); window.open(this.href, "_blank")}',
                            ],

                        ]);
                    },
                ],

                ],
        ];

        $model->columns();

        echo ZDynaWidget1::widget([
            'model' => $model,
            'rightName' => [
                'update',
                'report',
                'add-clone-delete',
            ],
            'config' => [
                'showPageSummary' => true,
                'isNewRecord' => true,

                'newRecordValues' => [
                    'models' => $models
                ],
            ]
        ]);

        ?>

    </div>

</div>

<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>



