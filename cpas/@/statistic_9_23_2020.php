<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\former\cpas\CpasTrackForm;
use zetsoft\models\cpas\CpasTracker;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;


/** @var ZView $this */


/**
 *
 * Action Params
 * @author Shahzod Gulomqodirov
 */

$action = new WebItem();

$action->title = Azl . 'Статистика';
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
echo $this->require( '\webhtm\cpas\blocks\header.php')
?>

<div id="page">


    
    <div id="content" class="content-footer p-3">

        <div class="row">
            <?

            $model = new CpasTrackForm();
            $model->configs->nameOff = [
                'id',
                'user',
                'stream',
                'stream_item'
            ];
            $model->columns();
            $data = Az::$app->cpas->cpasStats->generateClientStats();
            echo ZDynaWidget::widget([
                'data' => $data,
                'model' => $model,
                'type' => ZDynaWidget::type['form'],
                'rightBtn' => [
                    'system' => [
                        'content' => '{system}',
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
                        'content' => '',
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
                    'search' => true,
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

            ?>
        </div>


    </div>

</div>


<?php
echo $this->require( '\webhtm\cpas\blocks\footer.php');
 $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
