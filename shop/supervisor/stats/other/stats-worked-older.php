<?php

/**
 * Author:  Xolmat Ravshanov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\data\ALLApp;
use zetsoft\dbitem\data\Form;
use zetsoft\former\calls\CallsStatsAgentForm;
use zetsoft\models\shop\ShopOrder;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZDynaWidgetD;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\inputes\ZHHiddenInputWidget;
use zetsoft\widgets\inputes\ZKDateRangePickerWidget;
use zetsoft\widgets\inputes\ZPeriodPickerWidget;
use zetsoft\widgets\navigat\ZButtonWidget;

/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Заказы';
$action->icon = 'fa fa-pie-chart';
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
    require Root . '/webhtm/block/assets/main.php';

    $this->head();

    ?>

</head>


<body class="<?= ZWidget::skin['white-skin'] ?>">


<?php

$this->beginBody();

echo ZNProgressWidget::widget([]);


$this->beginBody();
require Root . '/webhtm/shop/agent/manual/header.php';
require Root . '/webhtm/shop/agent/manual/navbar.php';
?>


<div id="page">

    <?
    
    $data = Az::$app->calls->stats->agentWorkedTime();
    $post = $this->httpPost('ZDynamicModel');
    $dateBegin = null;
    $dateEnd = null;
    if (!empty($post)) {
        $dateBegin = $post['period'][0];
        $dateEnd = $post['period'][1];

        if (!empty($dateBegin) && !empty($dateEnd)) {

            $this->sessionSet('agent_status_period', $post['period']);
            $data = Az::$app->calls->stats->agentWorkedTime($dateBegin, $dateEnd);
            $this->urlRefresh();

        }
    }

    $session = $this->sessionGet('agent_status_period');
    if ($session) {
        $data = Az::$app->calls->stats->agentWorkedTime($session[0], $session[1]);
    }


    $model = new CallsStatsAgentForm();

    $app = new ALLApp();


    $column = new Form();
    $column->title = 'form_id';
    $column->widget = ZPeriodPickerWidget::class;
    $column->options = [
        'config' => [
            'valueStart' => 'start',
            'valueEnd' => 'end',
            'formatDateTime' => 'YYYY-MM-DD HH:mm:ss',
        ],
        'value' => $session ?? null
    ];


    $app->columns['period'] = $column;

    $model_d = Az::$app->forms->former->model($app);


    ?>
    <div class="col-sm-4  mt-n1">
        <?php
        $form = $this->ajaxBegin();
        ?>
        <div class="row">
            <div class="col-12 ">

                <?php


                echo ZFormWidget::widget([
                    'model' => $model_d,
                    'form' => $form,
                    'config' => [
                        'topBtn' => false,
                        'botBtn' => false,
                    ],
                ]); ?> </div>
            <div class="col-6 d-grid">
                <?php
                echo ZButtonWidget::widget([
                    'config' => [
                        'text' => Az::l('Филтровать'),
                        'btnType' => ZButtonWidget::btnType['submit'],
                        'btnRounded' => false,
                        'btnStyle' => 'text-success border border-success',
                        'btnSize' => 'btn-ml',
                        'class' => 'p-1 pl-3 pr-3',
                    ]

                ]);

                ?></div>

        </div>
        <?php
        $this->ajaxEnd();
        ?>
    </div>


    <?
    echo ZDynaWidget::widget([
        'model' => $model,
        'data' => $data,
        'type' => ZDynaWidget::type['form'],

    ]);

    ?>


    <? require Root . '\webhtm\block\footer\footerAdmin.php' ?>
    <?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>


