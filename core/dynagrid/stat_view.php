<?php


use rmrevin\yii\fontawesome\FA;
use zetsoft\dbitem\core\WebItem;
use zetsoft\models\dyna\DynaStats;
use zetsoft\service\forms\Active;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZFormWidget;
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

            $id = $this->httpGet('id');
            $stat = DynaStats::findOne($id);
           

            $depend = [];
            $post = $this->httpPost('ZDynamicModel');
            if ($post !== null)
                $post = array_filter($post);
            if ($post) {
                $st = ZArrayHelper::getValue($post, 'start_time');
                $et = ZArrayHelper::getValue($post, 'end_time');
                ZArrayHelper::remove($post, 'start_time');
                ZArrayHelper::remove($post, 'end_time');
                if ($st)
                    $stat->start_time = $st;
                if ($st)
                    $stat->end_time = $et;

                $stat->save();
                $depend = $post;

            }
            $stat->columns();
            //vdd($depend);
            Az::$app->smart->stats->clear();
            Az::$app->smart->stats->id = $id;
            Az::$app->smart->stats->dependValues = $depend;
            Az::$app->smart->stats->run();
            
            $model = Az::$app->smart->stats->createModel();
            // $model->kernel();
            $data = Az::$app->smart->stats->generateData();
            //vdd($data);
            $form = Az::$app->smart->stats->generateFilter();
            $active = new Active();
            $active->id = 'filter_form';
            $f = $this->activeBegin($active);
            if ($this->formModel($form)) {
            }
            ?>
            <div class="container">
                <?php
                if (!empty($form->columns)) {
                    echo ZFormWidget::widget([
                        'model' => $form,
                        'form' => $f,
                        'config' => [
                            'type' => ZFormWidget::type['allbl'],
                            'isCnt' => true,
                            'count' => 6,
                            'topBtn' => false,
                            'botBtn' => false,
                        ]
                    ]);

                    echo ZButtonWidget::widget([
                        'config' => [
                            'text' => Az::l('Филтировать'),
                            'btnRounded' => false,
                            'btnSize' => ZButtonWidget::btnSize['btn-md'],
                            'btnType' => ZButtonWidget::btnType['submit']
                        ],
                    ]);
                }
                ?>
            </div>
            <?php
            $this->activeEnd();

            $back = ZButtonWidget::widget([
                'config' => [
                    'icon' => 'fa fa-' . FA::_BACKWARD,
                    'url' => ZUrl::to([
                        '/core/dynagrid/statistics',
                        'dynaId' => $this->httpGet('dynaId'),
                        'url' => $this->httpGet('url'),
                        'modelName' => $this->httpGet('modelName'),
                    ]),
                ]
            ]);

            $home = ZButtonWidget::widget([
                'config' => [
                    'icon' => 'fa fa-' . FA::_HOME,
                    'url' => ZUrl::to([
                        '/' . $this->httpGet('url')
                    ]),
                ]
            ]);
            $model->configs->nameOff = [
                'value'
            ];

            echo ZDynaWidget::widget([
                'model' => $model,
                'data' => $data,
                'type' => ZDynaWidget::type['form'],
                'rightBtn' => [
                    'nav' => [
                        'content' => $back . $home,
                        'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                    ]
                ],

                'rightName' => [
                    'nav'
                ],
                
                'config' => [

                    'summary' => true,
                    //'hasToolbar' => false,

                    'search' => false,
                    'pjax' => false
                ]
            ]);

            ?>

        </div>
    </div>
    <?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
