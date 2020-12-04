<?php

/**
 *
 * @author MurodovMirbosit
 *
 **/


use zetsoft\dbitem\core\WebItem;
use zetsoft\former\shop\ShopDailyReportForm;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\system\Az;

/** @var ZView $this */

/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Ежедневный отчёт';
$action->icon = 'fal fa-calendar-times-o';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = false;
$action->layout = true;
$action->layoutFile = 'admin';



$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

?>
<div id="page">

    <?

    echo ZSessionGrowlWidget::widget(); ?>

    <div id="content">
        <?php
        $this->pjaxBegin();
        $model = new ShopDailyReportForm();

        $data = Az::$app->market->reportsNurbek->dailyReport();

        echo ZDynaWidget::widget([
            'model' => $model,
            'data' => $data,
            'type' => ZDynaWidget::type['form'],
            'config' => [
                'pjax'=>false,
                'type' => 'form',
                'showPageSummary' => true,
                'hasToolbar' => true,
                'columnBefore' => false,
                'actionButtons' => false,
                'columnAfter' => false,
                'createTitle' => Az::l('Создание прихода в склад')
            ],
        ]);
        $this->pjaxEnd();
        ?>

    </div>
</div>
