<?php


use kartik\grid\DataColumn;
use rmrevin\yii\fontawesome\FA;
use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\data\TabItem;
use zetsoft\models\dyna\DynaChess;
use zetsoft\models\dyna\DynaChessItem;
use zetsoft\models\dyna\DynaConfig;
use zetsoft\models\page\PageAction;
use zetsoft\system\actives\ZActiveRecord;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZListWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\navigat\ZSmartTabWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\widgets\themes\ZTabForDynaWidget;

$modelClass = $this->httpGet('modelClass');
$id = (int)$this->httpGet('id');

if (empty($id))
    throw new Exception('Необходимый параметр не найден');

$report = DynaChess::findOne($id);
$title = 'Редактировать ';
if (!empty($report))
    $title .= $report->name;

$action = new WebItem();

$action->title = $title;
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

    echo ZSessionGrowlWidget::widget(); ?>

    <div id="content" class="content-footer p-3">

        <?php

        $this->pjaxBegin();

        $modelClass = $this->httpGet('modelClass');
        $id = (int)$this->httpGet('id');

        if (empty($id))
            throw new Exception('Необходимый параметр не найден');

        $model = new DynaChessItem();

        $model->configs->query = DynaChessItem::find()
            ->where([
                'dyna_chess_id' => $id
            ]);

        $model->configs->readonly = [
            'dyna_chess_id' => true,
            'name' => false
        ];

        $chess = ZButtonWidget::widget([
            'config' => [
                'hasIcon' => true,
                'title' => '',
                'target' => ZButtonWidget::target['_self'],
                'grapes' => false,
                'url' => ZUrl::to([

                    '/core/dynagrid/dynaChessCreate',
                    'modelClass' => $modelClass

                ]),
                'class' => 'pb-4 ml-1 rounded-0',
                'btnStyle' => ZButtonWidget::btnStyle['btn-transparent'],
                'btnRounded' => false,
                'icon' => 'fa fa-backward fa-lg' . FA::_CLIPBOARD,
            ],
        ]);

        $model->columns();

        echo ZDynaWidget::widget([

            'model' => $model,

            'rightBtn' => [
                'update' => [
                    'content' => "{update}{$chess}",
                    'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                ],
            ],

            'config' => [
                'title' => $title,
                'showPageSummary' => true,
                'isNewRecord' => true,

                'newRecordValues' => [
                    'dyna_chess_id' => $id
                ],

            ]

        ]);

        $this->pjaxEnd();
        ?>

    </div>

</div>

<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>



