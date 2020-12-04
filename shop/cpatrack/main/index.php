<?php

use kartik\grid\DataColumn;
use zetsoft\dbitem\core\WebItem;
use zetsoft\former\cpas\CpasTrackForm;
use zetsoft\system\Az;
use zetsoft\system\column\ZKDataColumn;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\menus\ZMmenuWidgetSh;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\track\CpasTeaser;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . Az::l('Заказы');
$action->icon = 'fal fa-graduation-cap';
$action->type = WebItem::type['html'];
$action->csrf = true;

if ($this->httpGet('spa'))
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
    require Root . '/webhtm/block/assets/main.php';

    $this->head();

    ?>

</head>


<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php

$this->beginBody();

echo ZNProgressWidget::widget([]);
if (!$this->httpGet('spa'))
    echo ZMmenuWidget::widget();
?>

<div id="page">

    <?
    if (!$this->httpGet('spa'))
        require Root . '/webhtm/block/navbar/admin.php';

    echo ZSessionGrowlWidget::widget();?>
    <div id="content" class="content-footer p-3">


        <div class="row">
            <div class="col-md-12">

                <?php
                    $form = Az::$app->cpas->cpasStats->createCpasTrackForm();
                    
                ?>
                <?
                $model = new CpasTrackForm();
                $model->configs->before = [
    'title' => [
                        [
                            'class' => ZKDataColumn::class,
                            'label' => 'Полная информация',
                            'width' => '100px',
                            'value' => function ($model, $key, $index, DataColumn $dataColumn) {
                                return ZButtonWidget::widget([
                                    'config' => [
                                        'text' => 'Смотреть',
                                        'url' => 'stats.aspx?id=' . $model->id
                                    ]
                                ]);
                            }
                        ],

                    ]
                ];

                $model->columns();

                /** @var ZView $this */
                echo ZDynaWidget::widget([
                    'model' => $model,
                    'data' => $form,
                    'type' => ZDynaWidget::type['form'],

                ]);

                ?>

            </div>
        </div>


    </div>
<!--    --><?//= $this->require( '/webhtm\block\footer\mplace\footerAll.php') ?>
</div>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
