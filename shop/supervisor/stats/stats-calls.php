<?php

/**
 * Author:  Xolmat Ravshanov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 */

use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\data\ALLApp;
use zetsoft\dbitem\data\Form;
use zetsoft\former\calls\CallsStatsForm;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\inputes\ZPeriodPickerCallWidget;
use zetsoft\widgets\inputes\ZPeriodPickerWidget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\navigat\ZButtonWidget;

/** @var ZView $this */


/**
 *
 * Action Params
 */


$action = new WebItem();

$action->title = Azl . 'Статусы звонков';
$action->icon = 'fa fa-pie-chart';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;
$action->layout = true;
$action->layoutFile = 'admin';

$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();


?>


<div id="page">

    <?

    $data = Az::$app->calls->stats->agentCallStast();

    $post = $this->httpPost('ZDynamicModel');

    $dateBegin = null;
    $dateEnd = null;

    if (!empty($post)) {

        $dateBegin = $post['period'][0];
        $dateEnd = $post['period'][1];

        if (!empty($dateBegin) && !empty($dateEnd)) {

            $dateBegin = strtotime($dateBegin);
            $dateEnd = strtotime($dateEnd);

            $dateBegin = date('d/m/Y H:i:s', $dateBegin);
            $dateEnd = date('d/m/Y H:i:s', $dateEnd);

            $setValue = [];

            $setValue[] = $dateBegin;
            $setValue[] = $dateEnd;

            //$this->paramSet('stats_calls_cdr', $setValue);

            $this->sessionSet('stat_status', $post['period']);

            $data = Az::$app->calls->stats->agentCallStast($dateBegin, $dateEnd);

            $this->urlRefresh();

        }

    }

    $session = $this->sessionGet('stat_status');

    if ($session) {

        $session[0] = strtotime($session[0]);
        $session[1] = strtotime($session[1]);

        $session[0] = date('d/m/Y H:i:s', $session[0]);
        $session[1] = date('d/m/Y H:i:s', $session[1]);

        $data = Az::$app->calls->stats->agentCallStast($session[0], $session[1]);
    }

    $model = new CallsStatsForm();

    $model->columns();
    $app = new ALLApp();

    $column = new Form();
    $column->title = 'Статистика звонков';
    $column->hasLabel = false;
    $column->widget = ZPeriodPickerCallWidget::class;
    $column->options = [
        'config' => [
            'valueStart' => 'start',
            'valueEnd' => 'end',
            'formatDateTime' => 'YYYY-MM-DD HH:mm:ss',
            'timepicker' => true,
        ],
        'value' => $session ?? null
    ];

    $app->columns['period'] = $column;

    $model_d = Az::$app->forms->former->model($app);

    ?>
    <div class="col-sm-8">
        <?php
        $form = $this->ajaxBegin();
        ?>
        <div class="d-flex align-items-end">
            <!--            <div class="col-12">-->
            <div class="mx-5">

                <?php

                echo ZFormWidget::widget([
                    'model' => $model_d,
                    'form' => $form,
                    'config' => [
                        'topBtn' => false,
                        'botBtn' => false,
                    ],
                ]);

                ?>

            </div>
            <div class="mx-4">
                <?php
                echo ZButtonWidget::widget([
                    'config' => [
                        'text' => Az::l('Филтровать'),
                        'btnType' => ZButtonWidget::btnType['submit'],
                        'btnRounded' => false,
                        'btnStyle' => 'text-success border border-success',
                        'btnSize' => 'btn-ml',
                        'class' => 'p-2 pl-3 pr-3 mb-0',
                    ],

                    /*'event' => [
                        'click' => 'function() {
                            loction.reload()
                        }',
                    ]*/


                ]);
                ?>
            </div>
            <div class="mx-3">
                <?php
                echo ZButtonWidget::widget([
                    'config' => [
                        'text' => Az::l('Очистить  фильтр'),
                        'btnType' => ZButtonWidget::btnType['button'],
                        'btnRounded' => false,
                        'btnStyle' => 'text-success border border-success',
                        'btnSize' => 'btn-ml',
                        'class' => 'p-2 pl-3 pr-3 mb-0',
                    ],
                    'event' => [
                        'click' => <<<JS
                                        function() {
                                                $.ajax({
                                                    type: 'POST',
                                                    url: '/core/product/rangeClearCalls.aspx',
                                                    success: function (response) {
                                                        location.reload();
                                                    },
                                                });
                                            
                                        }
JS
                    ],
                ]);
                ?>
            </div>
            <!--            </div>-->

            <!--            <div class="col-6 d-grid">-->
            <!--                --><?php
            //                echo ZButtonWidget::widget([
            //                    'config' => [
            //                        'text' => Az::l('Филтровать'),
            //                        'btnType' => ZButtonWidget::btnType['submit'],
            //                        'btnRounded' => false,
            //                        'btnStyle' => 'text-success border border-success',
            //                        'btnSize' => 'btn-ml',
            //                        'class' => 'p-1 pl-3 pr-3',
            //                    ],
            //
            //                    /*'event' => [
            //                        'click' => 'function() {
            //                            loction.reload()
            //                        }',
            //                    ]*/
            //
            //
            //                ]);
            //
            //                ?>
            <!--            </div>-->
            <!--            <div class="col-6 d-grid">-->
            <!--                --><?php
            //                echo ZButtonWidget::widget([
            //                    'config' => [
            //                        'text' => Az::l('Очистить фильтр'),
            //                        'btnType' => ZButtonWidget::btnType['button'],
            //                        'btnRounded' => false,
            //                        'btnStyle' => 'text-success border border-success',
            //                        'btnSize' => 'btn-ml',
            //                        'class' => 'p-1 pl-3 pr-3',
            //                    ],
            //                    'event' => [
            //                        'click' => <<<JS
            //                                        function() {
            //                                                $.ajax({
            //                                                    type: 'POST',
            //                                                    url: '/core/product/rangeClearCalls.aspx',
            //                                                    success: function (response) {
            //                                                        location.reload();
            //                                                    },
            //                                                });
            //
            //                                        }
            //JS
            //                    ],
            //                ]);
            //                ?>
            <!--            </div>-->
        </div>
        <?php
        $this->ajaxEnd();
        ?>
    </div>

    <?
    echo ZDynaWidget::widget([
        'model' => $model,
        'data' => $data,
        'rightNameEx' => [
            'system',
            'add-clone-delete'
        ],
        'type' => ZDynaWidget::type['form'],
        'config' => [
            'hasToolbar' => true,
        ],
        'rightBtn'=>[
            'export' => [
                'content' => '{jsonExcel}',/*{exportAll}{excelBosya}*/
                'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
            ],
],
        'leftBtn' => [
            'search' => '',
        ]


    ]);

    ?>

</div>



