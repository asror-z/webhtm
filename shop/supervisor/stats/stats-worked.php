<?php

/**
 * Author:  Daho
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 */

use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\data\ALLApp;
use zetsoft\dbitem\data\Form;
use zetsoft\former\calls\CallsStatsAgentForm;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\inputes\ZPeriodPickerCallWidget;


/** @var ZView $this */


/**
 *
 * Action Params
 */


$action = new WebItem();


$action->title = Azl . 'Статистика по времени работы операторов';
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

    $data = Az::$app->calls->stats->agentWorkedTime();
    $post = $this->httpPost('ZDynamicModel');

    $dateBegin = null;
    $dateEnd = null;
    if (!empty($post)) {

        $setSessionArray = [];
        $dateBegin = $post['period'][0];
        $dateEnd = $post['period'][1];


        //vdd($beginDate);
        $beginDate = strtotime($dateBegin);
        $endDate = strtotime($dateEnd);

        $beginDate = date('d/m/Y H:i:s', $beginDate);
        $endDate = date('d/m/Y H:i:s', $endDate);

        $setSessionArray[] = $beginDate;
        $setSessionArray[] = $endDate;


        if (!empty($beginDate) && !empty($endDate)) {

            $this->sessionSet('agent_status_worked', $setSessionArray);
            $data = Az::$app->calls->stats->agentWorkedTime($beginDate, $endDate);
            $this->urlRefresh();

        }
    }

    $session = $this->sessionGet('agent_status_worked');
    if ($session) {
        $data = Az::$app->calls->stats->agentWorkedTime($session[0], $session[1]);
    }

    $model = new CallsStatsAgentForm();
    $model->configs->nameOff = [
        'id'
    ];
    $model->columns();
    
    $app = new ALLApp();
    $column = new Form();
    $column->title = 'form_id';
    $column->widget = ZPeriodPickerCallWidget::class;
    $column->options = [
        'config' => [
            'valueStart' => 'start',
            'valueEnd' => 'end',
            'formatDateTime' => 'YYYY-MM-DD H:i:s',
            'timepicker' => true
        ],
        'value' => $session ?? null
    ];


    $app->columns['period'] = $column;

    $model_d = Az::$app->forms->former->model($app);
    
    $model_d->configs->title = 'Статистика операторов';

    echo ZDynaWidget::widget([
        'model' => $model,
        'data' => $data,
        'rightNameEx' => [
            'system',
            'add-clone-delete',
        ],
        'rightBtn' => [
            'export' => [
                'content' => '{jsonExcel}',
                'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
            ],
        ],

        'leftNameEx' => [
            'search'
        ],

        'type' => ZDynaWidget::type['form'],

        'leftBtn' => [
            'newBtn' => [
                'content' => '<div class="d-inline-flex">' . $this->require('/webhtm/shop/agent/manual/periodFilter.php', [
                            'model_d' => $model_d,
                        ]
                    ) . '</div>',
                'options' => [
                    'class' => '',
                ]
            ]
        ],
    ]);

    ?>

</div>

