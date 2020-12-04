<?php


use kartik\grid\DataColumn;
use rmrevin\yii\fontawesome\FA;
use zetsoft\dbitem\core\WebItem;
use zetsoft\models\dyna\DynaChess;
use zetsoft\system\actives\ZModel;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
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
        <?php

        $modelClassName = $this->httpGet('modelClass');

        $ids = $this->httpGet('ids');

        $chess_id = $this->httpGet('id');

        $ids = explode('|', $ids);
           
        if (empty($modelClassName))
            throw new Exception('Необходимый параметр не найден');

        $modelFull = $this->bootFull($modelClassName);

        $model = new $modelFull();

        $model->configs->query = $modelFull::find()->where([
            'id' => $ids
        ]);
         
        $model->configs->readonly = true;

       $all = ZButtonWidget::widget([
            'config' => [
                'hasIcon' => true,
                'title' => '',
                'grapes' => false,
                'url' => ZUrl::to([
                    '/core/dynagrid/chess_view',
                    'id' => $chess_id
                ]),
                'class' => "pb-4 ml-1 rounded-0",
                'btnStyle' => ZButtonWidget::btnStyle['btn-transparent'],
                'btnRounded' => false,
                'icon' => 'text-muted  fa-lg fal fa-home',
            ],
        ]);


        $model->configs->dynaButtons = [
            'update' => [
                'content' => "{update}{$all}",
                'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
            ],
        ];


        $model->columns();

        echo ZDynaWidget::widget([

            'model' => $model,

            'rightNameEx' => [
                'system'
            ],

            'config' => [

                'spaArray' => [
                    'update' => false
                ],

                'pjax' => false,

                'hasToolbar' => true,

                'columnBefore' => [
                    'serial',
                    'action'
                        ],

                'columnAfter' => ['false'],

                'paginationOptions' => [

                    'defaultPageSize' => 5,
                    'limit' => 30,

                ],

                'actionButtons' => [
                    ''
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



