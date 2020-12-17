<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\cpas\CpasFinance;
use zetsoft\system\assets\ZColor;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\themes\ZCardWidget;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Заказать выплату';
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

require Root . '/webhtm/block/navbar/mainArbit.php';


echo ZNProgressWidget::widget([]);

echo ZNProgressWidget::widget([]);


?>

<div id="page">

    <?
    
    echo ZSessionGrowlWidget::widget();?>

    <div id="content" class="content-footer p-3">

        <div class="container-fluid mb-3">
            <?
            $form = $this->activeBegin();
            $model = new CpasFinance();
            $model->configs->readonly = true;
            $model->configs->nameOn = [
                'pay',
                'type',
            ];
            $model->columns();
            $this->modelSave($model);
            echo ZFormBuildWidget::widget([
                'model' => $model,
                'form' => $form,
                'config' => [
                    'stepType' => ZFormBuildWidget::stepType['none'],
                    'blockType' => ZFormBuildWidget::blockType['card'],
                    'stepOptions' => [],
                    'blockOptions' => [
                        'config' => [
                            'headerColor' => ZColor::color['green-special'],
                            'classHeadColor' => 'bg-white text-dark px-3 pb-3',
                        ]
                    ],
                    'isStepsVertical' => true,
                    'topBtn' => false,
                    'botBtn' => true,
                    'btnTitle' => null,
                    'isCard' => true,
                    'btnClass' => '',
                    'count' => 3,
                    'btnStyle' => ZButtonWidget::btnStyle['btn-outline-default'],
                ]
            ]);
            if($this->modelSave($model)){
                $model->status = 'Выплачено';
                $model->save();
            }
            $this->activeEnd();
            ?>
        </div>
        <div class="container-fluid">


            <?
            ZCardWidget::begin([
                'config' => [
                    'title' => '',
                    'type' => ZCardWidget::type['dynCard'],
                    'classHeadColor' => 'bg-white text-dark',
                    //'headerRight' => $btn,
                    //'footerText' => $footer,
                    'hasFooter' => true,
                    'footerColor' => ZColor::color['green-special'] . ' text-black',
                ]
            ]);
            $model = new CpasFinance();
            $model->configs->readonly = true;
            $model->configs->nameOn = [
                'created_at',
                'pay',
                'type',
                'status',
            ];
            $model->columns();
            echo ZDynaWidget::widget([
                'model' => $model,
                'config' => [
                    'showFooter' => false,
                    'titleSummary' => true,
                    'isCard' => false,
                    'columnBefore' => false,
                    'columnAfter' => false,
                    'hasToolbar' => false,
                    'search' => false,
                    'heighbody' => '100%',
                    'filter' => false,
                    'summary' => true,
                    'perfectScrollbar' => false,
                    'striped' => false,
                    'hasWidth' => false,
                ]
            ]);
            ZCardWidget::end();
            ?>
        </div>


    </div>

</div>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
